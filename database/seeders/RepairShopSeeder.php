<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RepairShop;

class RepairShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RepairShop::insert(
            [

                [
                    'name' => 'Fast Fix Vélo',
                    'address' => '123 Rue de Paris',
                    'phone' => '0123456789',
                    'latitude' => 48.8766,
                    'longitude' => 2.3522
                ],


                [
                    'name' => 'Vélo lovers',
                    'address' => '77 avenue Kennedy',
                    'phone' => '0123456789',
                    'latitude' => 48.9566,
                    'longitude' => 2.4522,
                ],


                [
                    'name' => 'Réparation Vélos',
                    'address' => 'Boulevard Haussmann',
                    'phone' => '0123456789',
                    'latitude' => 48.8566,
                    'longitude' => 2.4522,
                ],


                [
                    'name' => 'Allô Vélo',
                    'address' => 'Rue de l\'ouest Paris',
                    'phone' => '0123456789',
                    'latitude' => 48.6566,
                    'longitude' => 2.5522,
                ],


                [
                    'name' => 'Bee Very Green bikes',
                    'address' => 'Rue victoire',
                    'phone' => '0123456789',
                    'latitude' => 48.8766,
                    'longitude' => 2.3722,
                ],


                [
                    'name' => 'Velib4You',
                    'address' => 'Rue velo',
                    'phone' => '0123456789',
                    'latitude' => 48.8566,
                    'longitude' => 2.3422,
                ],
            ]
        );
    }
}
