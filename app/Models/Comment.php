<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @method static paginate(int $int)
 * @method static create(mixed $data)
 * @method static find(int $id)
 * @method static findOrFail(int $id)
 */
class Comment extends Model
{
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function files(): MorphToMany
    {
        return $this->morphToMany(File::class, "filable");
    }
}
