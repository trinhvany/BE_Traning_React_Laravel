<?php

namespace App\Http\Requests\Faculty;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacultyRequest extends FormRequest
{
    public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
            'id'                =>  'required|unique:faculties,id,' .$this->id,
			'name'              =>  'required|min:1',
		];
	}
	public function messages()
	{ {
			return [
				'required'        => ':attribute cannot be left blank',
				'min'            => ':attribute too short',
                'exists'          => ':attribute does not exist'
			];
		}
	}
	public function attributes()
	{
		return [
			'name'        => 'Name',
            'id'          => 'Faculty'
		];
	}
}
