<?php


namespace Cblink\UserAccount\Requests;

use Illuminate\Validation\Rule;
use Cblink\UserAccount\AccountConst;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SendSmsRequest
 * @package Cblink\UserAccount\Requests
 */
class SendSmsRequest extends FormRequest
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
            'mobile' => ['required'],
            'country_number' => ['nullable'],
            'scene' => ['required', Rule::in(AccountConst::SCENE)],
            'platform' => ['nullable', 'string'],
        ];
    }
}
