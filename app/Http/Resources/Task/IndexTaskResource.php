<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Project\IndexProjectTaskResource;
use App\Http\Resources\User\IndexUserTaskResource;
use App\Models\EntityStatus;
use App\Models\Project;
use App\Models\User;
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
 * @property int $creator_id
 */
class IndexTaskResource extends JsonResource
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
            "status" => $this->status,
            "project" => new IndexProjectTaskResource($this->project),
            "creator" => new IndexUserTaskResource(User::query()->find($this->creator_id)),
            "created_at" => $this->created_at
        ];
    }
}
