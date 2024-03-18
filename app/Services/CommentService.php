<?php

namespace App\Services;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentService
{
    public function index(): LengthAwarePaginator|array
    {
        return Comment::paginate(8)->withQueryString();
    }

    public function store(StoreCommentRequest $request): Comment
    {
        $data = $request->validated();
        return Comment::create($data);
    }

    public function show(int $id): ?Comment
    {
        return Comment::with("files")->findOrFail($id);
    }

    public function update(UpdateCommentRequest $request, int $id): ?Comment
    {
        $data = $request->validated();
        $founded = Comment::findOrFail($id);
        $founded->update($data);
        return $founded;
    }

    public function destroy(int $id): array
    {
        if (!Comment::destroy($id)) {
            abort(404);
        }
        return ["message" => "Comment with id $id deleted"];
    }
}
