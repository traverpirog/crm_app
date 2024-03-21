<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\FileResource;
use App\Models\EntityStatus;
use App\Models\Project;
use Date;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property EntityStatus $status
 * @property Date $created_at
 * @property array $files
 * @property array $comments
 * @property Project $project
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
            "comments" => $this->comments,
            "created_at" => $this->created_at
        ];
    }
}
