<?php

namespace Database\Seeders;

use App\Models\Racket;
use Illuminate\Database\Seeder;

class RacketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Racket::count() == 0) {
            Racket::factory(10)->create();
        }
    }
}
