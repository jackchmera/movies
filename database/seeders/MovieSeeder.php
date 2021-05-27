<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('movies')
            ->insert(array(
                array(
                    'title'        => 'Akademia Pana Kleksa',
                    'release_year' => 1984,
                    'cover'        => 'https://fwcdn.pl/fph/37/34/3734/641815_1.1.jpg'
                ),
                array (
                    'title'        => 'Sami swoi',
                    'release_year' => 1967,
                    'cover'        => 'https://fwcdn.pl/fph/11/13/1113/64240.1.jpg',
                )
            ));
    }
}
