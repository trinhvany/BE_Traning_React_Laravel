<?php

namespace App\Repositories;

use App\Models\Faculty;
use App\Repositories\EloquentRepository;

class FacultyRepository extends EloquentRepository
{

	/**
	 * get model
	 * @return string
	 */
	public function getModel()
	{
		return Faculty::class;
	}
}
