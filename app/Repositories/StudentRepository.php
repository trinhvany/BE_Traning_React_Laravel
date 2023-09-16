<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\EloquentRepository;

class StudentRepository extends EloquentRepository
{
	/**
	 * get model
	 * @return string
	 */
	public function getModel()
	{
		return Student::class;
	}

	/**
	 * get all student
	 * @return array
	 */
	public function getAll()
	{
		$result = $this->getModel()::select( 'students.*','majors.name as major_name')
									->join('majors','students.major_id', '=', 'majors.id')
									->get();
		return $result;
	}

	/**
	 * find student 
	 * @param  integer $student_id
	 * @return object
	 */
	public function find($student_id) 
	{
		$result = $this->getModel()::select('majors.faculty_id','students.*')
									->join('majors', 'students.major_id', '=', 'majors.id')
									->where('students.id', $student_id)
									->first();
		
		return $result;
	}

	/**
	 * delete mutiple students
	 * @param array $attributes
	 */
	public function deleteMutiple(array $attributes)
	{
		Student::whereIn('id', $attributes)->delete();
	}

	/**
	 * toArray list student
	 * @param object $student
	 * @return array $data
	 */
	public function toArray($student)
	{
		$data = [
			'id'			=> $student->id,
			'student_id'	=> $student->student_id,
			'phone'			=> $student->phone,
			'address'		=> $student->address,
			'email'			=> $student->email,
			'major_id'		=> $student->major_id,
			'gender'		=> $student->gender,
			'birthday'		=> $student->birthday,
			'name'			=> $student->name,
		];
		return $data;
	}


}
