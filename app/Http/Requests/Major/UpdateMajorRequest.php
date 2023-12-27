<?php

namespace App\Http\Requests\Major;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMajorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
	{
		return [
            'id'                =>  'required|unique:majors,id,' .$this->id,
			'name'			=>  'required|min:1|regex:/^([a-zA-Z ])+$/',
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
                'exists'          => ':attribute does not exist'
			];
		}
	}
	public function attributes()
	{
		return [
			'name'		=> 'Name',
			'faculty_id'	=> 'Faculty',
            'id'            => 'Major',
		];
	}
}
