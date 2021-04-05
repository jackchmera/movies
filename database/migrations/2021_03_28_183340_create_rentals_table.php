<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('movie_id');
            $table->date('rental_date');
            $table->date('watched');
            $table->integer('note');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
        });
        
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('contacts');
    }
}
