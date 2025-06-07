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
                'stock_id' => 'STK-INGR001',
                'stock_name' => 'Coffee Beans',
                'stock_status' => true,
                'stock_type' => 'ingredients',
                'userid' => 1, // Assumes the first user has ID 1
            ],
            [
                'stock_id' => 'STK-MACH001',
                'stock_name' => 'Coffee Machine',
                'stock_status' => true,
                'stock_type' => 'machine',
                'userid' => 1,
            ],
            [
                'stock_id' => 'STK-TOOL001',
                'stock_name' => 'Coffee Grinder',
                'stock_status' => true,
                'stock_type' => 'tools',
                'userid' => 1,
            ],
            [
                'stock_id' => 'STK-INGR002',
                'stock_name' => 'Milk',
                'stock_status' => true,
                'stock_type' => 'ingredients',
                'userid' => 1,
            ],
            [
                'stock_id' => 'STK-TOOL002',
                'stock_name' => 'Measuring Cups',
                'stock_status' => true,
                'stock_type' => 'tools',
                'userid' => 1,
            ],
        ];

        foreach ($stocks as $stock) {
            Stock::updateOrCreate(
                ['stock_id' => $stock['stock_id']], // The unique identifier
                $stock // The data to update or create with
            );
        }
    }
} 