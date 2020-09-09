<?php

namespace App\Mappers;

use App\Models\Book;

class BookMapper
{
    public function map(Book $book): array
    {
        return [
            'id' => $book->id,
            'name' => $book->name,
            'categoryId' => $book->category_id,
            'categoryName' => optional($book->category)->name,
        ];
    }
}
