<?php

namespace App\Http\Resources;

use App\Models\EntityStatus;
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
            "status" => $this->status,
            "files" => $this->files,
            "comments" => $this->comments,
            "created_at" => $this->created_at
        ];
    }
}
