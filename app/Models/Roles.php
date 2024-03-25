<?php

namespace App\Models;

enum Roles: string
{
    case CONTENT = "CONTENT";
    case SEO = "SEO";
    case PROGRAMMER = "PROGRAMMER";
    case MANAGER = "MANAGER";
    case ADMIN = "ADMIN";
}
