<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Orders (Induk Checkout - TANPA tenant_id)
        Schema::create('orders', function (Blueprint $table): void {
            $table->id();
            $table->string('order_number', 50)->unique();
            $table->unsignedBigInteger('total_amount'); // Nominal Rupiah (BIGINT)
            $table->enum('status', ['pending', 'paid', 'cancelled', 'completed'])->default('pending');
            $table->timestamps(6);
        });

        // 2. Tabel Tenant Orders (Pesanan per Toko/Tenant)
        Schema::create('tenant_orders', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->unsignedBigInteger('subtotal_amount');
            $table->unsignedBigInteger('commission_amount'); // Snapshot komisi
            $table->enum('status', ['pending', 'cooking', 'ready', 'completed', 'cancelled'])->default('pending');
            $table->timestamps(6);

            $table->unique(['tenant_id', 'id']); // Composite unique untuk child
        });

        // 3. Tabel Order Items (Item Pesanan Makanan)
        Schema::create('order_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->unsignedBigInteger('menu_id');
            $table->string('menu_name_snapshot', 120); // Snapshot nama menu
            $table->unsignedBigInteger('price_snapshot'); // Snapshot harga
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('subtotal_amount');
            $table->timestamps(6);

            // Composite Foreign Key: Memastikan menu_id milik tenant_id yang sama
            $table->foreign(['tenant_id', 'menu_id'])
                ->references(['tenant_id', 'id'])
                ->on('menus')
                ->restrictOnDelete();
        });

        // 4. Tabel Payments (Pembayaran & Idempotency Key)
        Schema::create('payments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('order_id')->constrained()->restrictOnDelete();
            $table->string('idempotency_key', 100)->unique(); // Mencegah 2x transaksi berulang
            $table->string('payment_method', 30); // Misal: QRIS
            $table->unsignedBigInteger('amount');
            $table->enum('status', ['pending', 'success', 'failed', 'expired'])->default('pending');
            $table->timestamps(6);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('tenant_orders');
        Schema::dropIfExists('orders');
    }
};
