<?php

namespace App\Http\Requests\User;

use App\Traits\ResponseApi;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateRequest extends FormRequest
{
    use ResponseApi;

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
            'email'    => 'required|email|string|unique:users,email,' . $this->id,
            'name'     => 'required|string|max:100',
            'password' => 'nullable|min:8'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $res = $this->errorValidation("Invalid request", $validator->errors(), 400);
        throw new \Illuminate\Validation\ValidationException($validator, $res);
    }

}
