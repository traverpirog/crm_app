<?php

namespace App\Http\Requests\Task;

use App\Models\EntityStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
            "title" => "required|string",
            "description" => "nullable|string",
            "project_id" => "int|required",
            "users_id" => "array",
            "status" => [Rule::enum(EntityStatus::class)]
        ];
    }

    public function messages(): array
    {
        return [
            "status" => "The status must be [" .
                EntityStatus::ACTIVE->value . ", " .
                EntityStatus::PAUSE->value . ", " .
                EntityStatus::FINISH->value .
                "]"
        ];
    }
}
