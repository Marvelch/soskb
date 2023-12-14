<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class salesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = [
            'Admin',
            'Lina',
            'Roby',
            'Ridwan',
            'Vacant',
            'Riksa',
            'Ridwan D',
            'Robby ',
            'Putri',
            'Salsa',
            'Taufik',
            'Dian',
            'Aldo',
            'Fadlun Amir',
            'Wahyudi',
            'Asep',
            'HARTATIK',
            'Plot SPG',
            'Vacant ASPR Tangerang',
            'Sulaiman',
            'Vacant ASPR Bogor',
            'Sutri',
            'Vacant ASPR Jakarta',
            'Vacant SPR Bogor',
            'Vacant Jakarta',
            'Nissa',
            'Agha'
        ];

        foreach ($sales as $key => $item) {
            User::create([
                'name' => $item,
                'email' => strtolower(str_replace(' ', '', $item)).'@mail.com',
                'account_type' => 'USR',
                'password' => Hash::make('123456789')
            ]);
        }
    }
}
