<?php

namespace App\Enums;


enum Job: string
{
    case FULLTIME = 'full-time';
    case PARTTIME = 'part-time';

    case DRAFT    = 'draft';
    case OPEN     = 'open';
    case CLOSED   = 'closed';

    public static function typeOptions(): array
    {
        return collect(self::cases())
            ->filter(
                fn($case) =>
                in_array($case, [self::FULLTIME, self::PARTTIME])
            )
            ->mapWithKeys(fn($case) => [
                $case->value => str($case->value)->replace('-', ' ')->title()
            ])
            ->toArray();
    }

    public static function statusOptions(): array
    {
        return collect(self::cases())
            ->filter(
                fn($case) =>
                in_array($case, [self::DRAFT, self::OPEN, self::CLOSED])
            )
            ->mapWithKeys(fn($case) => [
                $case->value => ucfirst($case->value)
            ])
            ->toArray();
    }
}
