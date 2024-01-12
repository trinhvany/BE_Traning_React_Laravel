<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}
	public function rules()
	{
		return [
			'student_id'	=>  'unique:students,student_id',
			'name'			=>  'required|min:1|regex:/^([a-zA-Z ])+$/|max:191',
			'email'			=>  'required|email|unique:students,email|max:191',
			'birthday'		=>  'date|before:today',
			'gender'		=>  'required|numeric|between:0,2',
			'password'		=>  'required|between:8,50',
			'address'		=>  'required|min:4|max:191',
			'phone'			=>  'required|numeric|digits:10|regex:/^0[0-9]{9}$/',
			'major_id'		=>  'required|numeric|min:1',
		];
	}
	public function messages()
	{
		{
			return [
				'required'		=> ':attribute cannot be left blank',
				'alpha'			=> ':attribute must be a string of characters from the alphabet',
				'major_id.min'	=> ':attribute invalid',
				'min'			=> ':attribute too short',
				'between'		=> ':attribute between 8 and 50 character',
				'unique'		=> ':attribute already exist',
				'digits'		=> ':attribute must be 10 number charater ',
				'date'			=> ':attribute must be date',
				'email'			=> ':attribute must be email',
				'numeric'		=> ':attribute must be number',
				'before'		=> ':attribute is bigger than current date',
				'regex'			=> ':attribute must be phone number 0xxxxxxxxx',
			];
		}
	}
	public function attributes()
	{
		return [
			'student_id'=> 'Student ID',
			'name'		=> 'Name',
			'address'	=> 'Address',
			'phone'		=> 'Phone Number',
			'gender'	=> 'Gender',
			'major_id'	=> 'Major',
			'email'		=> 'Student Email',
			'birthday'	=> 'Birthday',
			'password'	=> 'Password',
		];
	}
}
