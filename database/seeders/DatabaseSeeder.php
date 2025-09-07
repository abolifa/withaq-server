<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'عبدالرحمن أبوليفة',
            'username' => 'kishmee',
            'email' => 'admin@gmail.com',
            'phone' => '0910918885',
        ]);
    }
}
