<?php

namespace App\Http\Requests\Jobs;

use App\Enums\Job\JobStatus;
use App\Enums\Job\JobType;
use Illuminate\Validation\Rules\Enum;

class UpdateJobRequest extends BaseJobRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type'        => ['sometimes', new Enum(JobType::class)],
            'title'       => ['sometimes', 'string', 'max:48'],
            'status'      => ['sometimes', new Enum(JobStatus::class)],
            'location'    => ['sometimes', 'nullable', 'string', 'max:48'],
            'departament' => ['sometimes', 'nullable', 'string', 'max:48'],
        ];
    }
}
