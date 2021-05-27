<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rentals')
            ->insert(array(
                array(
                    'user_id'     => 1,
                    'movie_id'    => 1,
                    'note'        => 10,
                    'rental_date' => '2021-03-20 12:00:00',
                    'watched'     => '2021-03-20 13:00:00'
                )
            ));
    }
}
