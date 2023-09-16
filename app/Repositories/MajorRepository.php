<?php

namespace App\Repositories;

use App\Models\Major;
use App\Repositories\EloquentRepository;

class MajorRepository extends EloquentRepository
{

	/**
	 * get model
	 * @return string
	 */
	public function getModel()
	{
		return Major::class;
	}

	/**
	 * Find major by faculty
	 * 
	 * @param integer $faculty_id
	 * @return array
	 */
	public function findByFaculty($faculty_id) 
	{
		return $this->getModel()::where('faculty_id', $faculty_id)->get();
	}
}
