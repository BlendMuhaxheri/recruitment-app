<?php

namespace App\Enums\Job;

enum JobType: string
{
    case FULLTIME = 'full-time';
    case PARTTIME = 'part-time';

    public static function options(): array
    {
        return [
            self::FULLTIME->value => 'Full Time',
            self::PARTTIME->value => 'Part Time',
        ];
    }
}
