<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\File\FileResource;
use App\Http\Resources\User\IndexUserResource;
use App\Models\EntityStatus;
use App\Models\Project;
use App\Models\Task;
use Date;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property EntityStatus $status
 * @property Date $created_at
 * @property array $files
 * @property Project $project
 * @property array $users
 * @property int $creator_id
 * @property array $comments
 */
class TaskResource extends JsonResource
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
            "title" => $this->title,
            "description" => $this->description,
            "project" => $this->project,
            "status" => $this->status,
            "files" => FileResource::collection($this->files),
            "creator" => $this->creator_id,
            "users" => IndexUserResource::collection($this->users),
            "comments" => CommentResource::collection($this->comments),
            "created_at" => $this->created_at
        ];
    }
}
