<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventory = [
            [
                'branch_id' => 1,
                'stock_id' => 1,
                'userid' => 1,
                'quantity' => 10,
                'type' => 'stock_in',
                'reason' => 'Initial stock',
                'status' => true,
                'tag' => 'INITIAL'
            ],
            [
                'branch_id' => 2,
                'stock_id' => 1,
                'userid' => 1,
                'quantity' => 5,
                'type' => 'stock_in',
                'reason' => 'New shipment',
                'status' => true,
                'tag' => 'SHIP001'
            ],
            [
                'branch_id' => 1,
                'stock_id' => 1,
                'userid' => 1,
                'quantity' => 2,
                'type' => 'stock_out',
                'reason' => 'Customer order',
                'status' => true,
                'tag' => 'ORDER001'
            ],
            [
                'branch_id' => 3,
                'stock_id' => 1,
                'userid' => 1,
                'quantity' => 8,
                'type' => 'stock_in',
                'reason' => 'Restock',
                'status' => true,
                'tag' => 'REST001'
            ],
            [
                'branch_id' => 2,
                'stock_id' => 1,
                'userid' => 1,
                'quantity' => 3,
                'type' => 'stock_out',
                'reason' => 'Damaged items',
                'status' => false,
                'tag' => 'DAM001'
            ]
        ];

        foreach ($inventory as $record) {
            Inventory::create($record);
        }
    }
}
