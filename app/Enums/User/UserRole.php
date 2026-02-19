<?php

namespace App\Enums\User;

enum UserRole: string
{
    case ADMIN     = 'admin';
    case RECRUITER = 'recruiter';
    case CANDIDATE = 'candidate';


    public function canCreateJobs(): bool
    {
        return match ($this) {
            self::ADMIN => true,
            default => false,
        };
    }

    public function canManageJobs(): bool
    {
        return match ($this) {
            self::ADMIN => true,
            default => false,
        };
    }

    public function canManageApplications(): bool
    {
        return match ($this) {
            self::ADMIN => true,
            default => false,
        };
    }
}
