<?php

namespace App\Models;

enum EntityStatus: string
{
    case ACTIVE = "Активен";
    case PAUSE = "В паузе";
    case FINISH = "Завершен";
}
