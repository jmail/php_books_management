<?php

namespace App\Mappers;

class PaginationMapper
{
    public function map(array $options = []): array
    {
        $options['page'] = $options['page'] ?? 1;
        $options['per_page'] = $options['per_page'] ?? 10;

        return $options;
    }
}
