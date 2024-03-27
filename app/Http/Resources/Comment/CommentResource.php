<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\User\IndexUserResource;
use App\Models\User;
use Date;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $comment
 * @property array $files
 * @property int $user_id
 * @property Date $created_at
 */
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "comment" => $this->comment,
            "files" => $this->files,
            "user" => new IndexUserResource(User::query()->findOrFail($this->user_id)),
            "created_at" => $this->created_at
        ];
    }
}
