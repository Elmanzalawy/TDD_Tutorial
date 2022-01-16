<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCrudTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_book_can_be_added_to_the_library()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'Mohamed'
        ]);

        $response->assertSuccessful(); //?assert 200 status code
        $this->assertCount(1, Book::all()); //?assert book count is 1


    }

    public function test_a_book_can_be_updated()
    {
        $book = $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'Mohamed'
        ]);

        $response = $this->put("books/1", [
            'title' => 'New Title',
            'author' => 'New Author'
        ]);

        // $response->assertOk(); //?assert 200 status code
        $response->assertRedirect("books/1"); //?assert method redirects to `/books` url
        $this->assertCount(1, Book::all()); //?assert book count is 1
    }

    public function test_a_book_can_be_deleted()
    {
        $book = $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'Mohamed'
        ]);

        $response = $this->delete("books/1");

        // $response->assertOk(); //?assert 200 status code
        $this->assertCount(0, Book::all()); //?assert book count is 1
        $response->assertRedirect('/books'); //?assert method redirects to `/books` url
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
