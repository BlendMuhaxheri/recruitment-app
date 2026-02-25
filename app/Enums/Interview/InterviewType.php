<?php

namespace App\Enums\Interview;

enum InterviewType: string
{
    case ZOOM   = 'zoom';
    case ONSITE = 'on_site';
    case PHONE  = 'phone';
}
