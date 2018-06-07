<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
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
            'account_type_id' => 'required|numeric|between:1,10',
            'date' => 'required|date|before_or_equal:' . Carbon::now()->format('Y-m-d'),
            'start_balance' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'code' => 'required|string|max:255|unique',
        ];
    }
}
