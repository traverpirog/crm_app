<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexTaskRequest extends FormRequest
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
            "limit" => [
                "integer",
                Rule::in([8, 16, 24])
            ],
            "order_by" => [
                "string",
                Rule::in("created_at")
            ],
            "order_dir" => [
                "string",
                Rule::in(["asc", "desc"])
            ]
        ];
    }

    public function messages(): array
    {
        return [
            "limit" => "limit must be in [8, 16, 24]"
        ];
    }
}
