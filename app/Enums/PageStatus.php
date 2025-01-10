<?php

namespace App\Enums;

enum PageStatus: string
{
    case PUBLISHED = 'published';
    case DRAFT = 'draft';
}
