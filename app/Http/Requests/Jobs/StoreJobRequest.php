<?php

namespace App\Http\Requests\Jobs;

use App\Enums\Job\JobStatus;
use App\Enums\Job\JobType;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class StoreJobRequest extends BaseJobRequest
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
            'type'        => ['required', new Enum(JobType::class)],
            'title'       => ['required', 'string', 'max:48'],
            'status'      => ['required', new Enum(JobStatus::class)],
            'location'    => ['nullable', 'string', 'max:48'],
            'departament' => ['nullable', 'string', 'max:48'],
        ];
    }
}
