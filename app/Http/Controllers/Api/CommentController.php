<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Requests\File\StoreFileRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\File\StoreFileResource;
use App\Models\Comment;
use App\Models\File;
use App\Models\Task;
use App\Services\Interfaces\CommentService;
use App\Services\Interfaces\FileService;
use Gate;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use League\CommonMark\Extension\CommonMark\Node\Inline\AbstractWebResource;

class CommentController extends Controller
{
    public function __construct(
        private readonly CommentService $commentService,
        private readonly FileService    $fileService
    )
    {
    }

    public function store(StoreCommentRequest $request, Task $task): CommentResource
    {
        $this->checkTaskAccess($task);
        return new CommentResource($this->commentService->store($request, $task));
    }

    public function update(UpdateCommentRequest $request, Task $task, Comment $comment): CommentResource
    {
        $this->checkCommentAccess($task, $comment);
        return new CommentResource($this->commentService->update($request, $comment));
    }

    public function destroy(Task $task, Comment $comment): JsonResponse
    {
        $this->checkCommentAccess($task, $comment);
        return response()->json($this->commentService->destroy($comment));
    }

    public function storeFile(StoreFileRequest $request, Task $task, Comment $comment): AnonymousResourceCollection
    {
        $this->checkCommentAccess($task, $comment);
        return StoreFileResource::collection($this->fileService->store($request, $comment->id, Comment::class));
    }

    public function destroyFile(Task $task, Comment $comment, File $file): JsonResponse
    {
        $this->checkCommentAccess($task, $comment);
        return response()->json($this->fileService->destroy($comment->id, $file->id, Comment::class));
    }
}
