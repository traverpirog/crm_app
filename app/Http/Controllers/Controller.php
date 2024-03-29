<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Roles;
use App\Models\Task;
use App\Models\User;
use Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function checkTaskAccess(Task $task): void
    {
        Gate::allowIf(
            fn(User $user) => $user->role === Roles::ADMIN->value ||
                !empty($user->tasks()->findOrFail($task->id))
        );
    }

    protected function checkCommentAccess(Task $task, Comment $comment): void
    {
        Gate::allowIf(
            fn(User $user) => !empty($user->tasks()->findOrFail($task->id)) &&
                !empty($user->comments()->findOrFail($comment->id))
        );
    }
}
