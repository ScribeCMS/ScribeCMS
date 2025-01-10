<?php

namespace App\Enums;

enum UserRole: string
{
    case OWNER = 'owner';
    case MANAGER = 'manager';
    case EDITOR = 'editor';
    case AUTHOR = 'author';
    case CONTRIBUTOR = 'contributor';
}
