<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Comment\IndexCommentRequest;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CommentService
{
    public function store(StoreCommentRequest $request, int $task_id);

    public function update(UpdateCommentRequest $request, int $task_id, int $comment_id);

    public function destroy(int $task_id, int $comment_id);
}
