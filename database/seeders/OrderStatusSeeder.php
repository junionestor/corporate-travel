<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_statuses')->updateOrInsert(
            ['id' => 1],
            [
                'name' => 'Solicitado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
        DB::table('order_statuses')->updateOrInsert(
            ['id' => 2],
            [
                'name' => 'Aprovado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
        DB::table('order_statuses')->updateOrInsert(
            ['id' => 3],
            [
                'name' => 'Cancelado',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
