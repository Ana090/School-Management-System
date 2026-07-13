<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
    public function rules()
    {
        return [
            'Name' => ['required', 'string', 'max:255'],
             'Email' => 'required|email|unique:students,email,' . $this->id,
            'Phone' => ['required'],
            'Address' => ['required', 'string', 'max:500'],
            'Date_of_Birth' => ['required', 'date'],
            'ClassRoom' => ['required'],
             'ID_number' => 'required|unique:students,ID_number,' . $this->id,
            'img' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }
    public function messages()
    {
        return [
            'Name.required' => 'Name is required.',
            'Name.max' => 'Name must not exceed 255 characters.',

            'Email.required' => 'Email is required.',
            'Email.email' => 'Please enter a valid email address.',
            'Email.unique' => 'This email is already taken.',

            'Phone.required' => 'Phone number is required.',
            'Phone.digits' => 'Phone number must be exactly 11 digits.',

            'Address.required' => 'Address is required.',

            'Date_of_Birth.required' => 'Date of birth is required.',
            'Date_of_Birth.date' => 'Please enter a valid date.',
            'Date_of_Birth.before' => 'Date of birth must be in the past.',

            'ClassRoom.required' => 'Class is required.',
            'ClassRoom.exists' => 'Selected class does not exist.',

            'ID_number.required' => 'ID number is required.',
            'ID_number.numeric' => 'ID number must be a number.',
            'ID_number.digits_between' => 'ID number must be between 6 and 20 digits.',
            'ID_number.unique' => 'This ID number is already used.',

            'img.image' => 'The file must be an image.',
            'img.mimes' => 'Image must be a file of type: jpg, jpeg, png.',
            'img.max' => 'Image size must not exceed 2MB.',
        ];
    }
}
