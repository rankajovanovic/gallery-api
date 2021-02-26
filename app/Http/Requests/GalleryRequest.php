<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            'name'=>"required|min:2|max:255",
            'description'=> "max:1000",
            // "images" => "array|min:1|required",
            // "images.*" => ['regex:/^(http)?s?:?(\/\/[^\']*\.(?:png|jpg|jpeg))/'],
            'user_id' => 'required'

        ];
    }
}
