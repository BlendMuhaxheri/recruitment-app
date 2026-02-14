<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;


class BaseJobRequest extends FormRequest
{
    public function validatedAttributes(): array
    {
        return $this->safe()->only([
            'type',
            'title',
            'status',
            'location',
            'departament'
        ]);
    }
}
