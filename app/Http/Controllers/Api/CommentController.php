<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Services\Interfaces\CommentService;
use Gate;
use Illuminate\Foundation\Auth\User;

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

    public function update(UpdateCommentRequest $request, int $task_id, int $comment_id)
    {
        $user = auth()->user();
        Gate::allowIf(fn() => !empty($user->comments()->findOrFail($comment_id)));
        return new CommentResource($this->service->update($request, $task_id, $comment_id));
    }

    public function destroy(int $task_id, int $comment_id)
    {
        return response()->json($this->service->destroy($task_id, $comment_id));
    }
}
