<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
	{
		return true;
	}
	public function rules()
	{
		return [
			'student_id'	=>  'unique:students,student_id,'.$this->id,
			'name'			=>  'required|min:1|regex:/^([a-zA-Z ])+$/',
			'email'			=>  'required|email|unique:students,email,'.$this->id,
			'birthday'		=>  'date',
			'gender'		=>  'required|numeric|between:0,1',
			'address'		=>  'required|min:4',
			'phone'			=>  'required|numeric|digits:10',
			'major_id'		=>  'required|numeric|min:1'
		];
	}
	public function messages()
	{
		{
			return [
				'required'		=> ':attribute cannot be left blank',
				'alpha'			=> ':attribute must be a string of characters from the alphabet',
				'min'			=> ':attribute too short',
				'between'    	=> ':attribute between 8 and 16 character',
				'unique'		=> ':attribute already exist',
				'digits'		=> ':attribute must be 10 number charater ',
				'date'			=> ':attribute must be date',
				'email'			=> ':attribute must be email',
				'numeric'		=> ':attribute must be number'
			];
		}
	}
	public function attributes()
	{
		return [
			'student_id'=> 'Student ID',
			'name'		=> 'Name',
			'address'	=> 'Address',
			'phone'		=> 'Phone',
			'gender'	=> 'Gender',
			'major_id'	=> 'Major',
			'email'		=> 'Email',
			'birthday'	=> 'Birthday',
		];
	}
}
