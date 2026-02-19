<?php

namespace App\Enums\Application;

enum ApplicationStage: string
{
    case Applied   = 'applied';
    case Screening = 'screening';
    case Interview = 'interview';
    case Offer     = 'offer';
    case Hired     = 'hired';
    case Rejected  = 'rejected';

    public static function options(): array
    {
        return [
            self::Applied->value   => 'Applied',
            self::Screening->value => 'Screening',
            self::Interview->value => 'Interview',
            self::Offer->value     => 'Offer',
            self::Hired->value     => 'Hired',
            self::Rejected->value  => 'Rejected',
        ];
    }
}
