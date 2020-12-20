<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdate extends FormRequest
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
                'name'=>'required|string',
                'price'=>'required|numeric'
            ];
       
    }
    public function message(){
        return[
            'name.required'=>'name is need',
            'name.string'=>'must be string',
            'price.required'=>'price must reqire'
        ];
        }
}
