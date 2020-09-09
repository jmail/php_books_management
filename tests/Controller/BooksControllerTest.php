<?php

namespace Tests\Controller;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

class BooksControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testListBooks(): void
    {
        factory(Book::class, 10)->create();
        $response = $this->call('GET', '/api/books', [], [], [], []);
        $content = json_decode($response->getContent());
        $this->assertEquals(Response::HTTP_OK, $content->code);
        $this->assertGreaterThan(5, count($content->data));
    }

    public function testCorrectCreateBook(): void
    {
        $book = factory(Book::class)->make();
        $response = $this->call('POST', '/api/books', [
            'name' => $book->name,
            'category_id' => $book->category_id,
        ]);
        $content = json_decode($response->getContent());
        $this->assertEquals(Response::HTTP_OK, $content->code);
        $this->assertEquals($book->name, $content->data->name);
        $this->assertDatabaseHas('books', [
            'name' => $book->name,
            'category_id' => $book->category_id
        ]);
    }

    public function testWrongCreateBook(): void
    {
        $response = $this->call('POST', '/api/books');
        $content = json_decode($response->getContent());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $content->code);
    }

    public function testCorrectUpdateBook(): void
    {
        $book = factory(Book::class)->create();
        $response = $this->call('POST', '/api/books/' . $book->id, [
            'name' => 'update book',
            'category_id' => $book->category_id
        ]);
        $content = json_decode($response->getContent());
        $this->assertEquals(Response::HTTP_OK, $content->code);
        $this->assertDatabaseHas('books', [
            'name' => 'update book',
            'category_id' => $book->category_id
        ]);
    }

    public function testWrongUpdateBook(): void
    {
        $book = factory(Book::class)->create();
        $response = $this->call('POST', '/api/books/' . $book->id, [
            'name' => $book->name,
            'category_id' => 'wrong category id'
        ]);
        $content = json_decode($response->getContent());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $content->code);
    }

    public function testDeleteBook(): void
    {
        $book = factory(Book::class)->create();
        $this->call('DELETE', '/api/books/' . $book->id);
        $this->assertDatabaseMissing('books', [
            'name' => $book->name,
            'category_id' => $book->category_id
        ]);
    }
}
