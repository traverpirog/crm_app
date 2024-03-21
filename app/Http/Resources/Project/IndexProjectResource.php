<?php

namespace App\Http\Resources\Project;

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
 */
class IndexProjectResource extends JsonResource
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
            "name" => $this->name,
            "description" => $this->description,
            "status" => $this->status,
            "active_tasks" => Task::where("project_id", $this->id)->where("status", EntityStatus::ACTIVE)->count(),
            "created_at" => $this->created_at
        ];
    }
}
