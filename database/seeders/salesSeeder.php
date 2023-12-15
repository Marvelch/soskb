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
            'admin',
            'Abdul Muslih',
            'Vacant Bekasi',
            'Subardi',
            'Heri Bertus',
            'Ridwan',
            'Nanang',
            'Asep',
            'Vacant',
            'Geddy',
            'Derry',
            'File',
            'Lusiana',
            'Addinul',
            'Vacant 2',
            'Vacant 3',
            'Ujang',
            'Fajar',
            'BAGUS KETUT',
            'FAJAR',
            'AL',
            'TSALIS',
            'Vacant ASPR Tangerang',
            'Sulaiman',
            'Sutri',
            'Vacant ASPR Jakarta',
            'Vacant ASPR Bogor',
            'Ridwan',
            'Roby',
            'Ridwan D',
            'Riksa',
            'Lina',
            'Vacant',
            'Fadlun Amir',
            'Wahyudi',
            'Asep',
            'Nissa',
            'Agha',
            'Janis',
            'Aldo',
            'Putri',
            'Dian',
            'Mar Aguan',
            'Dina',
            'Robby',
            'Taufik',
            'Salsa',
            'HARTATIK'
        ];

        foreach ($sales as $key => $item) {
            User::create([
                'name' => strtolower($item),
                'email' => strtolower(str_replace(' ', '', $item)).'@skbfood.com',
                'account_type' => 'USR',
                'password' => Hash::make('123456789')
            ]);
        }
    }
}
