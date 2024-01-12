<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'email'            =>  'required|string|email|max:191',
			'password'         =>  'required|string|between:8,50',
		];
	}
	public function messages()
	{
		return [
			'required'       => ':attribute cannot be left blank',
			'between'        => ':attribute must be between 8 and 50 character',
			'max'            => ':attribute to long',
			'string'         => ':attribute must be string',
			'email'          => ':attribute must be email'
		];
	}
	public function attributes()
	{
		return [
			'email'        => 'Email',
			'password'     => 'Password',
		];
	}
}
