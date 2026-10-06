<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        DB::table('animals')->insert([
            ['name' => 'Luna', 'species' => 'Cat', 'breed' => 'Domestic Shorthair', 'age' => 3, 'status' => 'available', 'arrived_at' => '2026-05-14'],
            ['name' => 'Max', 'species' => 'Dog', 'breed' => 'Labrador Retriever', 'age' => 5, 'status' => 'adopted', 'arrived_at' => '2026-03-22'],
            ['name' => 'Pepper', 'species' => 'Cat', 'breed' => 'Siamese', 'age' => 1, 'status' => 'available', 'arrived_at' => '2026-07-03'],
            ['name' => 'Rocky', 'species' => 'Dog', 'breed' => 'German Shepherd', 'age' => 7, 'status' => 'reserved', 'arrived_at' => '2026-04-30'],
            ['name' => 'Mochi', 'species' => 'Rabbit', 'breed' => 'Holland Lop', 'age' => 2, 'status' => 'available', 'arrived_at' => '2026-07-19'],
            ['name' => 'Daisy', 'species' => 'Dog', 'breed' => 'Beagle', 'age' => 4, 'status' => 'adopted', 'arrived_at' => '2026-02-11'],
            ['name' => 'Oliver', 'species' => 'Cat', 'breed' => 'Maine Coon', 'age' => 6, 'status' => 'available', 'arrived_at' => '2026-06-25'],
            ['name' => 'Biscuit', 'species' => 'Dog', 'breed' => 'Corgi', 'age' => 2, 'status' => 'available', 'arrived_at' => '2026-08-12'],
        ]);
    }
}
