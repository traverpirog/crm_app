<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Task\ProjectTaskResource;
use App\Models\EntityStatus;
use App\Models\Task;
use Date;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property EntityStatus $status
 * @property Date $created_at
 * @property array $tasks
 */
class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "description" => $this->description,
            "status" => $this->status,
            "tasks" => ProjectTaskResource::collection(
                Task::where("project_id", $this->id)
                    ->paginate(8)
            ),
            "created_at" => $this->created_at
        ];
    }
}
