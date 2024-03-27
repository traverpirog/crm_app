<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\IndexCommentRequest;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Services\Interfaces\CommentService;

class CommentController extends Controller
{
    private CommentService $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    public function store(StoreCommentRequest $request, int $task_id)
    {
        return new CommentResource($this->service->store($request, $task_id));
    }

    public function update(UpdateCommentRequest $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        //
    }
}
