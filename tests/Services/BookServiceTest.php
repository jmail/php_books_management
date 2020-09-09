<?php

namespace Tests\Services;

use App\Models\Book;
use App\services\BookService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

class BookServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var BookService
     */
    protected $bookService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bookService = app(BookService::class);
    }

    public function testGetAllBooks(): void
    {
        factory(Book::class, 10)->create();
        $response = $this->bookService->getAllBooks();
        $this->assertGreaterThan(5, count($response['data']));
    }

    public function testCorrectCreateBook(): void
    {
        $book = factory(Book::class)->make();
        $this->bookService->create([
            'name' => $book->name,
            'category_id' => $book->category_id
        ]);
        $this->assertDatabaseHas('books', [
            'name' => $book->name,
            'category_id' => $book->category_id
        ]);
    }

    public function testWrongCreateBook(): void
    {
        $response = $this->bookService->create([
            'category_id' => 'wrong category'
        ]);
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response['code']);
    }

    public function testCorrectUpdateBook(): void
    {
        $book = factory(Book::class)->create();
        $response = $this->bookService->update($book->id, [
            'name' => 'update book',
            'category_id' => $book->category_id
        ]);
        $this->assertEquals(Response::HTTP_OK, $response['code']);
        $this->assertDatabaseHas('books', [
            'name' => 'update book',
            'category_id' => $book->category_id
        ]);
    }

    public function testDeleteBook(): void
    {
        $book = factory(Book::class)->create();
        $response = $this->bookService->delete($book->id);
        $this->assertEquals(Response::HTTP_OK, $response['code']);
        $this->assertDatabaseMissing('books', [
            'name' => $book->name,
            'category_id' => $book->category_id
        ]);
    }
}
