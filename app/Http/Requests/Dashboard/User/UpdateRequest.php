<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'email'         => ['required','email',\Illuminate\Validation\Rule::unique('users', 'email')->ignore(request()->id)],
            'mobile'        => ['required','numeric',\Illuminate\Validation\Rule::unique('users', 'mobile')->ignore(request()->id)],
            'status'        => 'required|in:0,1',
            'roles'         => 'required',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg',
        ];
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.string'   => trans('validation.string'),
            'name.unique'   => trans('validation.unique'),
        ];
    }
}
