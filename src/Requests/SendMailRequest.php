<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\Requests;

use Cblink\UserAccount\AccountConst;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
