<?php

namespace Database\Seeders;

use App\Models\Friend;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Friend::factory()->count(50)->create();
    }
}
