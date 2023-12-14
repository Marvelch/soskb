<?php

namespace Database\Seeders;

use App\Models\customerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class customerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customerType = [
            'GT / MT',
            'Food Service',
        ];

        foreach ($customerType as $key => $item) {
            customerType::create([
                'name' => $item,
            ]);
        }
    }
}
