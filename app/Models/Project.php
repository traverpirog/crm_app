<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static paginate(int $limit)
 * @method static create(array $data)
 * @method static find(int $id)
 * @method static findOrFail(int $id)
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "status"
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
