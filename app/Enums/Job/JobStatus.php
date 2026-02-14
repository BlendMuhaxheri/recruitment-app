<?php

namespace App\Enums\Job;

enum JobStatus: string
{
    case DRAFT  = 'draft';
    case OPEN   = 'open';
    case CLOSED = 'closed';

    public static function options(): array
    {
        return [
            self::DRAFT->value  => 'Draft',
            self::OPEN->value   => 'Open',
            self::CLOSED->value => 'Closed',
        ];
    }
}
