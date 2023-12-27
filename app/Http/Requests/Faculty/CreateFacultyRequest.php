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
			'name'            =>  'required|min:1|regex:/^([a-zA-Z ])+$/',
		];
	}
	public function messages()
	{ {
			return [
				'regrex'        => '::attribute invalid',
				'required'        => ':attribute cannot be left blank',
				'min'            => ':attribute too short',
			];
		}
	}
	public function attributes()
	{
		return [
			'name'        => 'Name',
		];
	}
}
