<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'email' => ['required', 'string', 'email'],
        'password' => ['required', Password::min(8)->letters()->mixedCase()->symbols()->numbers()->uncompromised()],
        'first_name'=>['required','string'],
        'last_name'=>['required','string'],
        'compnay'=>['required','string'],
        'job'=>['required','string'],
        'country'=>['required','string'],
        'phone'=>['required','string'],
        'address'=>['required','string'],   
        'about'=>['required','string'],
        ];
    }
}
