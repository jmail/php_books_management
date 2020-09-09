<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\Category;
use App\services\BookService;
use App\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;


class BooksController extends Controller
{
    /**
     * @var BookService
     */
    protected $bookService;

    /**
     * @var ApiResponse
     */
    protected $apiResponse;

    public function __construct(BookService $bookService, ApiResponse $apiResponse)
    {
        $this->bookService = $bookService;
        $this->apiResponse = $apiResponse;
    }

    public function index(): JsonResponse
    {
        $books = $this->bookService->getAllBooks();
        return $this->apiResponse
            ->setData($books['data'] ?? [])
            ->setMeta($books['meta'] ?? [])
            ->setErrors($books['errors'] ?? [])
            ->setCode($books['code'])
            ->create();
    }

    public function create(StoreBookRequest $request): JsonResponse
    {
        $book = $this->bookService->create($request->all());
        return $this->apiResponse
            ->setData($book['data'] ?? [])
            ->setErrors($book['errors'] ?? [])
            ->setMessages($book['messages'] ?? [])
            ->setCode($book['code'])
            ->create();
    }

    public function update(StoreBookRequest $request, int $id): JsonResponse
    {
        $book = $this->bookService->update($id, $request->all());
        return $this->apiResponse
            ->setData($book['data'] ?? [])
            ->setErrors($book['errors'] ?? [])
            ->setMessages($book['messages'] ?? [])
            ->setCode($book['code'])
            ->create();
    }

    public function delete(int $id): JsonResponse
    {
        $book = $this->bookService->delete($id);
        return $this->apiResponse
            ->setData($book['data'] ?? [])
            ->setErrors($book['errors'] ?? [])
            ->setMessages($book['messages'] ?? [])
            ->setCode($book['code'])
            ->create();
    }
}
