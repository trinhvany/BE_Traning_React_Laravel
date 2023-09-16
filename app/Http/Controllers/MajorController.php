<?php

namespace App\Http\Controllers;

use App\Repositories\MajorRepository;

class MajorController extends Controller
{
	protected $majorRepository;

	/**
	 * Construct
	 */
	public function __construct(MajorRepository $majorRepository)
	{
		$this->majorRepository = $majorRepository;
	}

	/**
	 * Get all major
	 * @return array
	 */
	public function index() 
	{
		$major = $this->majorRepository->getAll();
		return response()->json([
			'data'	=> $major,
		],200);
	}

	/**
	 * Find major
	 * @param array $faculty_id
	 * @return array
	 */
	public function show($faculty_id)
	{
		$major_list = $this->majorRepository->findByFaculty($faculty_id);
		return response()->json([
			'data'	=> $major_list,
		],200);
	}
}
