<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Canteens (Kantin Induk)
        Schema::create('canteens', function (Blueprint $table): void {
            $table->id();
            $table->string('code', 30)->unique();
            $table->string('name', 120);
            $table->string('slug', 100)->unique();
            $table->timestamps(6);
        });

        // 2. Tabel Tenants (Toko/Vendor)
        Schema::create('tenants', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('canteen_id')->constrained()->restrictOnDelete();
            $table->string('code', 30);
            $table->string('slug', 100);
            $table->string('display_name', 120);
            $table->enum('status', ['pending', 'active', 'suspended', 'inactive'])->default('pending');
            $table->timestamps(6);
            $table->softDeletes(6);

            // Composite Unique Constraints sesuai Modul 3
            $table->unique(['canteen_id', 'code']);
            $table->unique(['canteen_id', 'slug']);
            $table->unique(['id', 'canteen_id']); // Memungkinkan Composite FK di child table
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
        Schema::dropIfExists('canteens');
    }
};
