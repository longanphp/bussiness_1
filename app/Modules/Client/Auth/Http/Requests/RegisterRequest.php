<?php

namespace App\Modules\Client\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegisterRequest.
 */
class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'phone' => ['required', 'unique:users', "regex:" . REGEX_PHONE],
            'email' => 'required|max:255|unique:users|email:rfc,filter',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
