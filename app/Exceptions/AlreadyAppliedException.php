<?php

namespace App\Exceptions;

use Exception;

class AlreadyAppliedException extends Exception
{
    public function __construct()
    {
        parent::__construct("You have already applied for this job.");
    }

    public function render($request)
    {
        return back()
            ->withErrors([
                'email' => $this->getMessage()
            ])
            ->withInput();
    }
}
