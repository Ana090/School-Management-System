<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRoomRequest extends FormRequest
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
            "Name" => ["required"],
            'code' => 'required|unique:class_rooms,code,' . $this->id,
            "teacher_id" => "required|unique:class_rooms,teacher_id," . $this->id,
            "Nu_of_St" => ["required"],
        ];
    }
    public function messages(): array
    {
        return [
            'Name.required' => 'Teacher name is required.',
            'code.unique' => 'Code Moust be unique',
            'teacher_id.unique' => 'Teacher Moust be  unique'
        ];

    }
}
