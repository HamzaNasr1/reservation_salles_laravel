<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create(['name' => 'Salle Turing']);
        Room::create(['name' => 'Salle Lovelace']);
        Room::create(['name' => 'Salle Hopper']);
    }
}
