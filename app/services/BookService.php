<?php

namespace App\services;

use App\Mappers\PaginationMapper;
use App\Mappers\BookMapper;
use App\Models\Book;
use App\Repositories\BookRepository;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class BookService
{
    /**
     * @var  PaginationMapper
     */
    protected $paginationMapper;

    /**
     * @var  BookMapper
     */
    protected $bookMapper;

    /**
     * @var BookRepository
     */
    protected $bookRepository;


    public function __construct(
        BookRepository $bookRepository,
        PaginationMapper $paginationMapper,
        BookMapper $bookMapper
    ) {
        $this->bookRepository = $bookRepository;
        $this->paginationMapper = $paginationMapper;
        $this->bookMapper = $bookMapper;
    }

    public function getAllBooks(): array
    {
        try {
            $books = $this->bookRepository->getAllBooks();
            $data = $books->map(function ($one) {
                return $this->bookMapper->map($one);
            })->toArray();
            return createReturnData([], Response::HTTP_OK, $data ?? [], [], []);
        } catch (Exception $e) {
            logger()->error('Can not list books', [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'parameters' => $options
            ]);

            return [
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'can not list books',
                'parameters' => $options
            ];
        }
    }

    public function create(array $bookData): array
    {
        try {
            $bookFillable = $this->bookRepository->makeModel()->getFillable();
            if ($book = $this->bookRepository->create(Arr::only($bookData, $bookFillable))) {
                return createReturnData([], Response::HTTP_OK, $book->toArray(), [
                    __('book has been created successfully')
                ]);
            }
            return createReturnData([
                __('book has not been created')
            ], Response::HTTP_UNPROCESSABLE_ENTITY, []);
        } catch (Exception $e) {
            Log::error($e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'stack-trace' => $e->getTraceAsString()
            ]);
            return createReturnData([
                __('book has not been created')
            ], Response::HTTP_UNPROCESSABLE_ENTITY, []);
        }
    }

    public function update(int $id, array $bookData): array
    {
        try {
            $book = $this->bookRepository->find($id);
            $bookFillable = $this->bookRepository->makeModel()->getFillable();
            if ($this->bookRepository->update(Arr::only($bookData, $bookFillable), $id)) {
                return createReturnData([], Response::HTTP_OK, $book->refresh()->toArray(), [
                    __('book has been updated successfully')
                ]);
            }
            return createReturnData([
                __('book has not been updated')
            ], Response::HTTP_UNPROCESSABLE_ENTITY, []);
        } catch (Exception $e) {
            Log::error($e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'stack-trace' => $e->getTraceAsString()
            ]);
            return createReturnData([
                __('book has not been updated')
            ], Response::HTTP_UNPROCESSABLE_ENTITY, []);
        }
    }

    public function delete(int $id): array
    {
        try {
            if ($this->bookRepository->delete($id)) {
                return createReturnData([], Response::HTTP_OK, [], [
                    __('book has been deleted successfully')
                ]);
            }
            return createReturnData([
                __('book has not been deleted')
            ], Response::HTTP_UNPROCESSABLE_ENTITY, []);
        } catch (Exception $e) {
            Log::error($e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'stack-trace' => $e->getTraceAsString()
            ]);
            return createReturnData([
                __('book has not been deleted')
            ], Response::HTTP_UNPROCESSABLE_ENTITY, []);
        }
    }
}
