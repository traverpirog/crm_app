<?php

namespace App\Repositories\Interfaces;

interface FileRepository
{
    public function store(array $data, int $taskId): array;

    public function destroy(int $taskId, int $id): ?string;
}
