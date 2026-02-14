<?php

namespace App\Enums\User;

enum UserRole: string
{
    case ADMIN     = 'admin';
    case COMPANY   = 'company';
    case CANDIDATE = 'candidate';


    public function canCreateJobs(): bool
    {
        return match ($this) {
            self::ADMIN,
            self::COMPANY => true,
            default => false,
        };
    }

    public function canManageJobs(): bool
    {
        return match ($this) {
            self::ADMIN,
            self::COMPANY => true,
            default => false,
        };
    }

    public function canDeleteJobs(): bool
    {
        return match ($this) {
            self::ADMIN,
            self::COMPANY => true,
            default => false,
        };
    }
}
