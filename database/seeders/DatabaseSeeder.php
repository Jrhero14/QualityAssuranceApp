<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $roles = [
            'supervisor',
            'operator'
        ];

        User::factory()->create([
            'name' => 'Supervisor',
            'email' => 'supervisor@email.com',
            'password' => Hash::make('super12345'),
            'role' =>  $roles[0]
        ]);

        User::factory()->create([
            'name' => 'April',
            'email' => 'april@email.com',
            'password' => Hash::make('operatorapril'),
            'role' => $roles[1]
        ]);

        User::factory()->create([
            'name' => 'Budi',
            'email' => 'budi@email.com',
            'password' => Hash::make('operatorbudi'),
            'role' => $roles[1]
        ]);

        // Items Data Seeder
        echo "Buat Dummy Data Item? (y/n): ";
        $confirm_input = fopen("php://stdin","r");
        $confirm = trim(fgets($confirm_input));

        while (!in_array($confirm, ['y', 'n'])){
            echo "Konfirmasi salah, ulangi (y/n): ";
            $confirm_input = fopen("php://stdin","r");
            $confirm = trim(fgets($confirm_input));
        }

        $dummyItems = [
            'CVR RR SEAT CUSHION HINGE RH',
            'BOARD, FR DOOR TRIM, UPR RH',
            'COVER FR SEAT HINGE RH',
            'CAP, FRONT PILLAR INR',
            'CVR SEAT TRACK BRACKET INNER'
        ];

        if ($confirm == 'y'){
            foreach ($dummyItems as $item){
                Item::factory()->create([
                    'part_name' => $item
                ]);
                echo 'ADD ITEM : '.$item.PHP_EOL;
            }
        }

        echo PHP_EOL."Seeder data success";
    }
}
