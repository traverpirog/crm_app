<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\DB;

/**
 * @method static paginate(int $int)
 * @method static create(mixed $data)
 * @method static where(mixed $param, mixed $value)
 */
class Task extends Model
{
    use HasFactory;

    protected $table = "tasks";
    protected $fillable = [
        "title",
        "description",
        "status",
        "project_id"
    ];

    public function files(): MorphToMany
    {
        return $this->morphToMany(File::class, "filable");
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "user_task");
    }
}
