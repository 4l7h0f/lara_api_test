<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userId = $this->route('user');

        $isUpdate = $this->method() === 'PUT' || $this->method() === 'PATCH';

        return [
            'name' => ($isUpdate ? 'sometimes|' : '') . 'required|string|max:255',
            'email' => ($isUpdate ? 'sometimes|' : '') . 'required|email|unique:users,email' . ($userId ? ",$userId" : ''),
            'password' => ($isUpdate ? 'sometimes|' : '') . 'required|string|min:6',
        ];
    }
}
