<?php

namespace Cblink\UserAccount\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package Cblink\UserAccount\Requests
 */
class LoginRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'account' => ['required'],
            'password' => ['nullable', 'string', 'min:6', 'max:32'],

            'captcha' => ['required_without:password', 'integer'],
            'captcha_key_id' => ['required_with:rand_code'],

            'bind_code' => ['nullable', 'string'],
        ];
    }

}

