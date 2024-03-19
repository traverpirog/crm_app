<?php

namespace App\Services;

use App\Http\Middleware\ImageUploader;
use App\Http\Requests\File\StoreFileRequest;
use App\Repositories\Interfaces\FileRepository;
use App\Services\Interfaces\FileService;

class FileServiceImpl implements FileService
{
    private FileRepository $repository;

    public function __construct(FileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(StoreFileRequest $request, int $taskId): array
    {
        $data = ImageUploader::upload($request->validated(), "tasks", $taskId);
        return $this->repository->store($data, $taskId);
    }

    public function destroy(int $id): bool
    {
        return false;
    }
}
