<?php

namespace App\Http\Requests\Task;

use App\Models\EntityStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
            "title" => "string",
            "description" => "string",
            "project_id" => "int",
            "status" => [Rule::enum(EntityStatus::class)],
            "users_id" => "array"
        ];
    }

    public function messages(): array
    {
        return [
            "status" => "The status must be [" .
                EntityStatus::ACTIVE->value . ", " .
                EntityStatus::FINISH->value .
                "]"
        ];
    }
}
