<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id('id');
            $table->string('title');
            $table->integer('release_year');
            $table->string('cover', 256);
            $table->timestamps();
        });
        
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('movies');
    }
}
