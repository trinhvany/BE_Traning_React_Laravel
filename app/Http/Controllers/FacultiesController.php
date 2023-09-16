<?php

namespace App\Http\Controllers;

use App\Repositories\FacultyRepository;

class FacultiesController extends Controller
{

	protected $facultyRepository;

	/**
	 * Construct
	 */
	public function __construct(FacultyRepository $facultyRepository)
	{
		$this->facultyRepository = $facultyRepository;
	}

	/**
	 * Get all faculty
	 * @return array
	 */
	public function index()
	{
		$faculties =  $this->facultyRepository->getAll();
		return response()->json([
			'data' => $faculties,
		], 200);
	}
}
