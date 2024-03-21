<?php

namespace App\Http\Requests\Project;

use App\Models\EntityStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
            "name" => "string|required",
            "description" => "string",
            "status" => [Rule::enum(EntityStatus::class)]
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
