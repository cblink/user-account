<?php

namespace Cblink\UserAccount\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MiniLoginRequest
 * @package Cblink\UserAccount\Requests
 */
class MiniLoginRequest extends FormRequest
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
            'code' => ['required', 'string'],
        ];
    }

}