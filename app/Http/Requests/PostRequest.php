<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostRequest extends FormRequest
{
	private $necessity = 'required';
	
	/**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function prepareForValidation() {

    	if (!JWTAuth::user()){
    		return;
	    }
    	    $this->necessity = 'nullable';
    }
	
	/**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	        'title' => 'required',
	        'description' => 'required',
	        'user_id' => $this->necessity,
        ];
    }
}
