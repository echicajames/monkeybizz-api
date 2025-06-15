<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            [
                'name' => 'Main Branch',
                'address' => '123 Main Street, City Center',
                'date_opened' => '2024-01-01',
                'status' => true,
                'rent_amount' => 50000.00,
                'rent_type' => 'monthly',
                'userid' => 1
            ],
            [
                'name' => 'North Branch',
                'address' => '456 North Avenue, North District',
                'date_opened' => '2024-02-15',
                'status' => true,
                'rent_amount' => 45000.00,
                'rent_type' => 'monthly',
                'userid' => 1
            ],
            [
                'name' => 'South Branch',
                'address' => '789 South Road, South District',
                'date_opened' => '2024-03-01',
                'status' => true,
                'rent_amount' => 40000.00,
                'rent_type' => 'monthly',
                'userid' => 1
            ],
            [
                'name' => 'East Branch',
                'address' => '321 East Boulevard, East District',
                'date_opened' => '2024-04-15',
                'status' => true,
                'rent_amount' => 35000.00,
                'rent_type' => 'monthly',
                'userid' => 1
            ],
            [
                'name' => 'West Branch',
                'address' => '654 West Street, West District',
                'date_opened' => '2024-05-01',
                'status' => true,
                'rent_amount' => 30000.00,
                'rent_type' => 'monthly',
                'userid' => 1
            ]
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
