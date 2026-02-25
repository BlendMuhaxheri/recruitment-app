<?php

namespace App\Http\Requests\Companies;

use App\Enums\Interview\InterviewType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreInterviewRequest extends FormRequest
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
            'scheduled_at' => [
                'required',
                'date',
                'after:now',
            ],

            'type' => [
                'required',
                Rule::enum(InterviewType::class),
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }
}
