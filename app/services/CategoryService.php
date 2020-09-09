<?php

namespace App\services;

use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Http\Response;

class CategoryService
{
    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories(): array
    {
        try {
            $categories = $this->categoryRepository->findAll();
            return createReturnData([], Response::HTTP_OK, $categories->toArray() ?? [], [], []);
        } catch (Exception $e) {
            logger()->error('Can not list categories', [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);

            return [
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'can not list categories'
            ];
        }
    }
}
