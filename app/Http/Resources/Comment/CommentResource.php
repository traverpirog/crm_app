<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\File\FileResource;
use App\Http\Resources\User\IndexUserResource;
use App\Models\User;
use Date;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
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
            "id" => $this->id,
            "comment" => $this->comment,
            "files" => FileResource::collection($this->files),
            "user" => new IndexUserResource(User::query()->findOrFail($this->user_id)),
            "created_at" => $this->created_at
        ];
    }
}
