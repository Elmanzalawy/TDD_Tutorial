<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'Mohamed'
        ]);

        $response->assertOk(); //?assert 200 status code
        $this->assertCount(1, Book::all()); //?assert book count is 1


    }

    public function test_a_book_title_is_required()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Mohamed'
        ]);

        $response->assertSessionHasErrors('title'); //?assert that a title is required
    }

    public function test_a_book_author_is_required()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'Cool Book Name',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author'); //?assert that an author is required
    }
}
