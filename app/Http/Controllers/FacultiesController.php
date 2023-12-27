<?php

namespace App\Http\Controllers;

use App\Http\Requests\Faculty\CreateFacultyRequest;
use App\Http\Requests\Faculty\UpdateFacultyRequest;
use App\Models\Major;
use App\Models\Student;
use App\Repositories\FacultyRepository;
use Illuminate\Http\Request;

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
		$data = [];
		foreach ($faculties as $item) {
			$total_of_major = Major::where('faculty_id', $item['id'])->count();
			$total_of_student = Student::where('faculty_id', $item['id'])->count();
			$item['total_student'] = $total_of_student;
			$item['total_major'] = $total_of_major;
			$data[] = $item;
		}

		return response()->json([
			'data' => $data,
		], 200);
	}

	/**
	 * Create new faculty
	 * @return array
	 */
	public function store(CreateFacultyRequest $request)
	{
		$data = $request->only(
			'name',
		);
		$this->facultyRepository->create($data);
		
		return response()->json([$request->all()],201);
	}

	public function show($id)
	{
		$faculty = $this->facultyRepository->find($id);
		return response()->json([
			'data' => $faculty,
		],200);
	}

	/**
	 * Update student
	 * @return bool
	 */
	public function update(UpdateFacultyRequest $request)
	{
		$data = $request->only(
			'id',
			'name',
		);
		$update = $this->facultyRepository->update($request->id, $data);

		if(! $update) {
			return response()->json([
				'status'=> false,
			],422);
		}
		return response()->json([
			'status' => true,
		],200);
	}

	public function destroy(Request $request)
	{
		$delete = $this->facultyRepository->delete($request->faculty_id);
		if(! $delete) {
			return response()->json([
				'status'=> false,
			],422);
		}
		return response()->json([
			'status' => true,
		],200);
	}

	public function deleteMutiple(Request $request)
	{
		$errors = [];
		foreach($request->list as $faculty_id) {
			$delete = $this->facultyRepository->delete($faculty_id);
			if(! $delete) {
				array_push($errors, $faculty_id);
			}
		}
		return response()->json([
			'errors' => $errors,
		],200);
	}
}
