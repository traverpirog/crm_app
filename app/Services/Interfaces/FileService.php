<?php

namespace App\Services\Interfaces;

use App\Http\Requests\File\StoreFileRequest;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Class_;

interface FileService
{
    public function store(StoreFileRequest $request, int $entityId, string $className): array;

    public function destroy(int $entityId, int $id, string $className): array;
}
