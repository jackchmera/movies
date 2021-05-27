<?php

namespace Tests\Unit;

use App\Http\Controllers\API\MovieController;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;
    
    private $movieController;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->movieController = new MovieController();
        $this->artisan('migrate:fresh');
        $this->seed();        
    }
    
    /**
     * Test case for Movie->index().
     */
    public function testIndex() : void
    {
        $expected = [
            [
                'id'           => 1,
                'title'        => 'Akademia Pana Kleksa',
                'release_year' => 1984,
                'cover'        => 'https://fwcdn.pl/fph/37/34/3734/641815_1.1.jpg',
                'avg_note'     => '10.0000'
            ],
            [
                'id'           => 2,
                'title'        => 'Sami swoi',
                'release_year' => 1967,
                'cover'        => 'https://fwcdn.pl/fph/11/13/1113/64240.1.jpg',
                'avg_note' => null
            ]
        ];
        
        $this->assertEquals($expected, $this->movieController->index());
    }
    
    /**
     * Test case for Movie->add().
     * 
     * @dataProvider addProvider
     */
    public function testAdd(Request $request) : void
    {
        $request->setMethod('POST');
        
        // Provider - "Incorrect set of data".
        $this->ifIsNotIntExpectedException($request->release_year);
        
        $this->movieController->add($request);
       
        // Provider - "Correct set of data".
        $this->ifIsIntAssertion($request);
    }
    
    public function addProvider() : array
    {
        return [
            'Correct set of data' => [new Request([], [
                'id'           => 3,
                'title'        => 'Czterej pancerni i pies',
                'release_year' => 1966,
                'cover'        => 'https://fwcdn.pl/fph/51/55/35155/490902_1.1.jpg'
            ])],
            'Incorrect set of data' => [new Request([], [
                'id'           => 3,
                'title'        => 'Czterej pancerni i pies',
                'release_year' => 'Incorrect date',
                'cover'        => 'https://fwcdn.pl/fph/51/55/35155/490902_1.1.jpg'
            ])]
        ];
    }

    /**
     * Test case for Movie->update().
     * 
     * @dataProvider updateProvider
     */
    public function testUpdate(Request $request) : void
    {
        $request->setMethod('POST');
        
        // Provider - "Incorrect set of data".
        $this->ifIsNotIntExpectedException($request->release_year);
        
        $this->movieController->update(Movie::find(1), $request);
        
        // Provider - "Correct set of data".
        $this->ifIsIntAssertion($request);
    }
    
    /**
     * Data provider for testUpdate().
     * 
     * @return array
     */
    public function updateProvider() : array
    {
        return [
            'Correct set of data' => [new Request([], [
                'id'           => 1,
                'title'        => 'Czterej pancerni i pies',
                'release_year' => 1966,
                'cover'        => 'https://fwcdn.pl/fph/51/55/35155/490902_1.1.jpg',
            ])],
            'Incorrect set of data' => [new Request([], [
                'id'           => 1,
                'title'        => 'Czterej pancerni i pies',
                'release_year' => 'Incorrect date',
                'cover'        => 'https://fwcdn.pl/fph/51/55/35155/490902_1.1.jpg',
            ])]
        ];
    }
    
    /**
     * Creates expected excetion for none int value (unexpected value).
     * 
     * @param type $release_year
     */
    private function ifIsNotIntExpectedException($release_year) : void
    {
        if (!is_int($release_year)) {
            $this->expectException(
                ValidationException::class,
                'Release year is not an int - ValidationException exception should be thrown.'
            );
        }
    }
    
    /**
     * Creates assertion for int (expected value).
     * 
     * @param Request $request
     * @return void
     */
    private function ifIsIntAssertion(Request $request) : void
    {
        if (is_int($request->release_year)) {
           $this->assertDatabaseHas('movies', $request->request->all());
        }
    }
    
    /**
     * Test case for Movie->delete().
     */
    public function testDelete() : void
    {
        $this->movieController->delete(Movie::find(2));
        
        $this->assertDatabaseMissing('movies', ['id' => 2]);
        
        //  TODO: Try to delete not existing entry.
        //  
        // $this->expectException(QueryException::class);
        // $this->expectExceptionCode(23000);
        // $movie = Movie::find(1);
        // $movie->delete();
    }
}
