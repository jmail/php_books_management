<?php

if (!function_exists('createReturnData')) {
    function createReturnData(array $errors, int $code, array $data, array $message = [], array $meta = []): array
    {
        return [
            'errors' => $errors,
            'code' => $code,
            'data' => $data,
            'messages' => $message,
            'meta' => $meta,
        ];
    }
}
