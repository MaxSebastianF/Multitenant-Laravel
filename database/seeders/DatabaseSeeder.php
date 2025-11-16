<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Test\GlobalSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Users\UserSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*$this->call([
            UserSeeder::class
        ]);*/
        $this->call([GlobalSeeder::class]);
    }
}
