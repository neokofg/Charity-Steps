<?php

namespace Database\Seeders;

use App\Models\UsersFills;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersFillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsersFills::factory()->count(5)->create();
    }
}
