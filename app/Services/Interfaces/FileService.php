<?php

namespace App\Services\Interfaces;

use App\Http\Requests\File\StoreFileRequest;

interface FileService
{
    public function store(StoreFileRequest $request, int $taskId): array;

    public function destroy(int $taskId, int $id): array;
}
