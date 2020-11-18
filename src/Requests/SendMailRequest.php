<?php

namespace Cblink\UserAccount\Requests;

use Illuminate\Validation\Rule;
use Cblink\UserAccount\AccountConst;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SendMailRequest
 * @package Cblink\UserAccount\Requests
 */
class SendMailRequest extends FormRequest
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


    public function rules()
    {
        return [
            'mail' => ['required', 'email'],
            'scene' => ['required', Rule::in(AccountConst::SCENE)],
            'platform' => ['nullable', 'string'],
        ];
    }
}
