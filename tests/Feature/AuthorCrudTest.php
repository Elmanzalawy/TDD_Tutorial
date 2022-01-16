<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @return void
     */
    public function test_an_author_can_be_created()
    {
        $response = $this->post('/authors', [
            'name' => "Author Name",
            'dob' => "1998/06/02",
        ]);

        $response->assertSuccessful();
        $author =  Author::first();

        $this->assertNotInstanceOf(Carbon::class, $author->dob);

    }
}
