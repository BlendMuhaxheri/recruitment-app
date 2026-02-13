<?php

namespace App\Http\Requests\Job;

use App\Enums\Job;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
            'type'        => ['required', new Enum(Job::class)],
            'title'       => ['required', 'string', 'max:48'],
            'status'      => ['required', new Enum(Job::class)],
            'location'    => ['nullable', 'string', 'max:48'],
            'departament' => ['nullable', 'string', 'max:48'],
        ];
    }

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
