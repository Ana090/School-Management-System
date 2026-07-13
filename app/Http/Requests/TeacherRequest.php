<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'Name' => ['required', 'string', 'max:255'],
            'Email' => 'required|email|unique:teachers,email,' . $this->id,
            'Phone' => ['required', 'string', 'max:20'],
            'Address' => ['required', 'string'],
            'status' => ['required'],
            'Suplation' => ['required', 'string'],
            'img' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'Name.required' => 'Teacher name is required.',
            'Name.max' => 'Teacher name must not exceed 255 characters.',

            'Email.required' => 'Email is required.',
            'Email.email' => 'Please enter a valid email address.',
            'Email.unique' => 'This email is already taken.',

            'Phone.required' => 'Phone number is required.',
            'Phone.max' => 'Phone number must not exceed 20 characters.',

            'Address.required' => 'Address is required.',

            'status.required' => 'Status is required.',

            'Suplation.required' => 'Specialization is required.',

            'img.image' => 'The file must be an image.',
            'img.mimes' => 'Only JPG, JPEG, and PNG files are allowed.',
            'img.max' => 'Image size must not exceed 2MB.',
        ];

    }

}
