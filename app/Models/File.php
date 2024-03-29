<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @method static create(array $data)
 * @property int $id
 */
class File extends Model
{
    protected $fillable = [
        "path",
        "type"
    ];

    public function tasks(): MorphToMany
    {
        return $this->morphedByMany(Task::class, "filable");
    }
}
