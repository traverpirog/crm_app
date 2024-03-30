<?php

namespace App\Utils;

use JetBrains\PhpStorm\Immutable;

#[Immutable]
enum Messages: string
{
    case TASK_SUBJ_STORE = "Created new task #%d";
    case TASK_SUBJ_UPDATE = "Task #%d updated";
}
