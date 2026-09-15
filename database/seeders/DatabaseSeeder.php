<?php

namespace Database\Seeders;

use App\Models\Canteen;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Kantin Pusat
        $canteen = Canteen::firstOrCreate(
            ['code' => 'KNT-01'],
            [
                'name' => 'Kantin Pusat Teknik',
                'slug' => 'kantin-pusat',
            ]
        );

        // 2. Tenant 1: Toko Nasi Goreng (HAPUS baris 'name')
        $tenant1 = Tenant::firstOrCreate(
            ['canteen_id' => $canteen->id, 'code' => 'TNT-01'],
            [
                'display_name' => 'Nasi Goreng Berkah',
                'slug' => 'nasgor-berkah',
                'status' => 'active',
            ]
        );

        $cat1 = Category::firstOrCreate([
            'tenant_id' => $tenant1->id,
            'name' => 'Makanan Utama',
        ]);

        Menu::firstOrCreate(
            ['tenant_id' => $tenant1->id, 'name' => 'Nasi Goreng Spesial'],
            [
                'category_id' => $cat1->id,
                'price_amount' => 15000,
                'is_available' => true,
            ]
        );

        // 3. Tenant 2: Toko Minuman (HAPUS baris 'name')
        $tenant2 = Tenant::firstOrCreate(
            ['canteen_id' => $canteen->id, 'code' => 'TNT-02'],
            [
                'display_name' => 'Es Segar',
                'slug' => 'es-segar',
                'status' => 'active',
            ]
        );

        $cat2 = Category::firstOrCreate([
            'tenant_id' => $tenant2->id,
            'name' => 'Minuman',
        ]);

        Menu::firstOrCreate(
            ['tenant_id' => $tenant2->id, 'name' => 'Es Teh Manis'],
            [
                'category_id' => $cat2->id,
                'price_amount' => 5000,
                'is_available' => true,
            ]
        );
    }
}
