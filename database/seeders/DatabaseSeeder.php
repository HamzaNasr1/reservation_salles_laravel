<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

     #   User::factory()->create([
     #       'name' => 'Test User',
     #       'email' => 'test@example.com',
     #   ]);
        $this->call(RoomsTableSeeder::class);
        #CETTE LIGNE APPELLE LE SEEDER RoomsTableSeeder 
        #POUR INSÉRER DES DONNÉES DANS LA TABLE ROOMS
        #php artisan db:seed
    }
}
