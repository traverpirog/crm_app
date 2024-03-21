<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Task\ProjectTaskResource;
use App\Models\EntityStatus;
use Date;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
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
            "name" => $this->name,
            "description" => $this->description,
            "status" => $this->status,
            "count" => ProjectTaskResource::collection($this->tasks)->count(),
            "created_at" => $this->created_at
        ];
    }
}
