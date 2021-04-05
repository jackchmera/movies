<?php

namespace Tests\Unit;

use App\Models\Movie;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Tests\CreatesApplication;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use CreatesApplication;
    use DatabaseTransactions;
    
    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --database="testing"');
    }
    
    /**
     * Test case for Movie->index().
     */
    public function testIndex() : void
    {
        $expected = [
            (object) [
                'id'           => 1,
                'title'        => 'Akademia Pana Kleksa',
                'release_year' => 1984,
                'cover'        => 'https://fwcdn.pl/fph/37/34/3734/641815_1.1.jpg',
                'avg_note'     => 10.0000
            ],
            (object) [
                'id'           => 2,
                'title'        => 'Sami swoi',
                'release_year' => 1967,
                'cover'        => 'https://fwcdn.pl/fph/11/13/1113/64240.1.jpg',
                'avg_note'     => null
            ]
        ];
        
        $actual = Movie::all();
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * Test case for Movie->add().
     * 
     * @dataProvider addProvider
     */
    public function testAdd ($expected) : void
    {   
        if (!is_int($expected['release_year'])) {
            $this->expectException(
                QueryException::class,
                'Query exception should be thrown.'
            );
        }
      
        $movie = new Movie($expected);
        $movie->save();
        
        $actual = Movie::find(3)->toArray();
        unset($actual['created_at'], $actual['updated_at']);
        
        if (is_int($expected['release_year'])) {
            $this->assertEquals(
                $expected,
                $actual,
                'Inserted records has not been found.'
            );
        }
    }
    
    public function addProvider () : array
    {
        return [
            'Correct set of data' => [[
                'id'           => 3,
                'title'        => 'Czterej pancerni i pies',
                'release_year' => 1966,
                'cover'        => 'https://fwcdn.pl/fph/51/55/35155/490902_1.1.jpg'
            ]],
            'Incorrect set of data' => [[
                'id'           => 3,
                'title'        => 'Czterej pancerni i pies',
                'release_year' => 'Incorrect date',
                'cover'        => 'https://fwcdn.pl/fph/51/55/35155/490902_1.1.jpg'
            ]]
        ];
    }

    /*
     * @dataProvider updateProvider
     */
    public function update($data) : void
    {
        if (!is_int($data['release_year'])) {
            $this->expectException(QueryException::class);
        }
        
        $movie        = Movie::find(1);
        $beforeUpdate = clone $movie;
        
        $movie->update($data);
        $actual = Movie::find(1);

        if (is_int($data['release_year'])) {
            $this->assertNotSame(
                $beforeUpdate,
                $actual,
                'The record has not been changed.'
            );
        }
    }
    
    /**
     * Data provider for testUpdate().
     * 
     * @return array
     */
    public function updateProvider () : array
    {
        return [
            'Correct set of data' => [[
                'id'           => 1,
                'title'        => 'Czterej pancerni i pies',
                'release_year' => 1966,
                'cover'        => 'https://fwcdn.pl/fph/51/55/35155/490902_1.1.jpg',
                'created_at'   => date('Y-m-d H:i:s', time()),
                'updated_at'   => date('Y-m-d H:i:s', time())
            ]],
            'Incorrect set of data' => [[
                'id'           => 1,
                'title'        => 'Czterej pancerni i pies',
                'release_year' => 'Incorrect date',
                'cover'        => 'https://fwcdn.pl/fph/51/55/35155/490902_1.1.jpg',
                'created_at'   => date('Y-m-d H:i:s', time()),
                'updated_at'   => date('Y-m-d H:i:s', time())
            ]]
        ];
    }
    
    /**
     * Test case for Movie->delete().
     */
    public function testDelete() : void
    {
        $movie = Movie::find(2);
        $movie->delete(2);
        
        $movie = Movie::find(2);
        $this->assertNull(
            $movie,
            'A movie has been found although should be deleted.'
        );
        
        $this->expectException(QueryException::class);
        $this->expectExceptionCode(23000);
        $movie = Movie::find(1);
        $movie->delete();
    }
}
