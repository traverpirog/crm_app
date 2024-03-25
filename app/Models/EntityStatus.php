<?php

namespace App\Models;

enum EntityStatus: string
{
    case ACTIVE = "ACTIVE";
    case PAUSE = "PAUSE";
    case FINISH = "FINISH";
}
