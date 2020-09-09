<?php

namespace App\Http\Controllers;

use App\services\CategoryService;
use App\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;


class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * @var ApiResponse
     */
    protected $apiResponse;

    public function __construct(CategoryService $categoryService, ApiResponse $apiResponse)
    {
        $this->categoryService = $categoryService;
        $this->apiResponse = $apiResponse;
    }

    public function index(): JsonResponse
    {
        $categories = $this->categoryService->getAllCategories();
        return $this->apiResponse
            ->setData($categories['data'] ?? [])
            ->setMeta($categories['meta'] ?? [])
            ->setErrors($categories['errors'] ?? [])
            ->setCode($categories['code'])
            ->create();
    }
}
