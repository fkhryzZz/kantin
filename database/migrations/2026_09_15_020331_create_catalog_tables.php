<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Kategori Menu (Per Tenant)
        Schema::create('categories', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->string('name', 100);
            $table->timestamps(6);

            $table->unique(['tenant_id', 'id']); // Untuk FK Komposit
        });

        // 2. Tabel Menus (Katalog Produk - Nominal Rupiah BIGINT)
        Schema::create('menus', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->unsignedBigInteger('category_id');
            $table->string('name', 120);
            $table->unsignedBigInteger('price_amount'); // Rupiah Simpan sebagai BIGINT (Bukan Float)
            $table->boolean('is_available')->default(true);
            $table->timestamps(6);

            // Composite Unique untuk sasaran FK Komposit di child
            $table->unique(['tenant_id', 'id']);

            // Foreign Key Komposit: Memastikan category_id milik tenant_id yang sama
            $table->foreign(['tenant_id', 'category_id'])
                ->references(['tenant_id', 'id'])
                ->on('categories')
                ->restrictOnDelete();
        });

        // 3. Tabel Modifiers (Misal: Extra Topik / Level Pedas per Tenant)
        Schema::create('modifiers', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->unsignedBigInteger('menu_id');
            $table->string('name', 100);
            $table->unsignedBigInteger('price_amount')->default(0);
            $table->timestamps(6);

            // Constraint Penting: Foreign Key Komposit Mencegah Modifier Lintas Tenant
            $table->foreign(['tenant_id', 'menu_id'])
                ->references(['tenant_id', 'id'])
                ->on('menus')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modifiers');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('categories');
    }
};
