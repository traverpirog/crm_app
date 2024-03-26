<?php

namespace App\Models;

enum Roles: string
{
    case USER = "user";
    case ADMIN = "admin";
}
