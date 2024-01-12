<?php

namespace App\Http\Requests\Major;

use Illuminate\Foundation\Http\FormRequest;

class CreateMajorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
	{
		return [
			'name'			=>  'required|min:1|regex:/^([a-zA-Z ])+$/|max:191',
			'faculty_id'		=>  'required|numeric|min:1'
		];
	}
	public function messages()
	{
		{
			return [
                'regrex'        => '::attribute invalid',
				'required'		=> ':attribute cannot be left blank',
				'faculty_id.min'	=> ':attribute invalid',
				'min'			=> ':attribute too short',
				'numeric'		=> ':attribute must be number',
				'max'            => ':attribute too long',
			];
		}
	}
	public function attributes()
	{
		return [
			'name'		=> 'Name',
			'faculty_id'	=> 'Faculty',
		];
	}
}
