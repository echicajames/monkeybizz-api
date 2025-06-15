<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Note: Make sure a user exists before running this seeder
        $stocks = [
            [
                'stock_name' => 'Coffee Beans',
                'stock_code' => 'CB001',
                'stock_status' => true,
                'category' => 'ingredients',
                'userid' => 1, // Assumes the first user has ID 1
            ],
            [
                'stock_name' => 'Coffee Machine',
                'stock_code' => 'MCH01',
                'stock_status' => true,
                'category' => 'machine',
                'userid' => 1,
            ],
            [
                'stock_name' => 'Coffee Grinder',
                'stock_code' => 'T0001',
                'stock_status' => true,
                'category' => 'tools',
                'userid' => 1,
            ],
            [
                'stock_name' => 'Milk',
                'stock_code' => 'ING123',
                'stock_status' => true,
                'category' => 'ingredients',
                'userid' => 1,
            ],
            [
                'stock_name' => 'Measuring Cups',
                'stock_code' => 'T0002',
                'stock_status' => true,
                'category' => 'tools',
                'userid' => 1,
            ],
        ];

        foreach ($stocks as $stock) {
            Stock::create($stock);
        }
    }
} 