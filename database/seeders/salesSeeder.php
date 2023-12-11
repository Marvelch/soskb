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
            'Robby',
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

        $id = [
            '119593',
            '119593',
            '119593',
            '119593',
            '119593',
            '119593',
            '119593',
            '183180',
            '115425',
            '183180',
            '98404',
            '183181',
            '183180',
            '183179',
            '183179',
            '183179',
            '135902',
            '126205',
            '183179',
            '183179',
            '183179',
            '183179',
            '183179',
            '183179',
            '183179',
            '126205',
            '126205'
        ];

        foreach ($sales as $key => $item) {
            User::create([
                'name' => $item,
                'email' => $item.'@mail.com',
                'account_type' => 'USR',
                'password' => Hash::make('123456789'),
                'region_id' => $id[$key]
            ]);
        }
    }
}
