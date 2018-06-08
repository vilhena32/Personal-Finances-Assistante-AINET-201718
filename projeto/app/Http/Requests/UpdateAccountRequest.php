<?php

namespace App\Http\Requests;

use App\Account;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
        //$account = request()->account;

        return [
            'account_type_id' => 'required|exists:account_types,id',
            'date' => 'required|date',
            'start_balance' => 'required|numeric|regex:/^-?\d*(\.\d{2})?$/',
            'description' => 'nullable|string|max:255',
            'code' => 'required|string|max:255|unique:accounts,code' ,//. $account->id,
        ];
    }
}