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
        DB::table(OrderStatus::class)->updateOrInsert([
            ['id' => 1, 'name' => 'Solicitado'],
            ['id' => 2, 'name' => 'Aprovado'],
            ['id' => 3, 'name' => 'Cancelado'],
        ]);
    }
}
