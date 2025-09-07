<?php

namespace Database\Seeders;

use App\Models\Outgoing;
use Illuminate\Database\Seeder;

class OutgoingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Outgoing::factory(20)->create();
    }
}
