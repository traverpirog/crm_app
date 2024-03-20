<?php

namespace App\Services;

use App\Http\Requests\File\StoreFileRequest;
use App\Repositories\Interfaces\FileRepository;
use App\Services\Interfaces\FileService;
use App\Utils\ImageUtil;

class FileServiceImpl implements FileService
{
    private FileRepository $repository;

    public function __construct(FileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(StoreFileRequest $request, int $taskId): array
    {
        $data = ImageUtil::upload($request->validated(), "tasks", $taskId);
        return $this->repository->store($data, $taskId);
    }

    public function destroy(int $taskId, int $id): array
    {
        $path = $this->repository->destroy($taskId, $id);
        if (!ImageUtil::delete($path)) {
            abort(404);
        }
        return ["message" => "File with id $id deleted"];
    }
}
