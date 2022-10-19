<?php

namespace App\Http\Requests\User;

use App\Traits\ResponseApi;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class FetchRequest extends FormRequest
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
            'search'    => 'nullable|string',
            'per_page'  => 'nullable|numeric|max:50|min:1',
            'page'      => 'nullable|numeric|min:1',
            'sort_by'   => 'nullable|string|in:id,created_at,name,email',
            'sort_direction' => 'nullable|string|in:ASC,DESC'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $res = $this->errorValidation("Invalid request", $validator->errors(), 400);
        throw new \Illuminate\Validation\ValidationException($validator, $res);
    }

}
