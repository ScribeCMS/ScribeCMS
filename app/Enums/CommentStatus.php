<?php

namespace App\Enums;

enum CommentStatus: string
{
    case PUBLISHED = 'published';
    case PENDING = 'pending';
    case SPAM = 'spam';
}
