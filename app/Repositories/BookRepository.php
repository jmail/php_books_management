<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Collection;

class BookRepository extends Repository
{

    public function model(): string
    {
       return Book::class;
    }

    public function getAllBooks(): Collection
    {
        return $this->model->with('category')->get();
    }
}
