<?php

namespace App\Http\Requests\Faculty;

use Illuminate\Foundation\Http\FormRequest;

class CreateFacultyRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name'            =>  'required|min:1|regex:/^([a-zA-Z ])+$/|max:191',
		];
	}
	public function messages()
	{ 
		return [
			'regrex'        => '::attribute invalid',
			'required'        => ':attribute cannot be left blank',
			'min'            => ':attribute too short',
			'min'            => ':attribute too long',
		];
		
	}
	public function attributes()
	{
		return [
			'name'        => 'Name',
		];
	}
}
