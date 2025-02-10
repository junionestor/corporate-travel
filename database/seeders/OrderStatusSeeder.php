<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
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
                ['name' => 'Solicitado'],
        );
        DB::table('order_statuses')->updateOrInsert(
            ['id' => 2,],
                ['name' => 'Aprovado'],
        );
        DB::table('order_statuses')->updateOrInsert(
            ['id' => 3,],
                ['name' => 'Cancelado'],
        );
    }
}
