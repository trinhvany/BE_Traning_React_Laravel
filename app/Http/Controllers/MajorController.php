<?php

namespace App\Http\Controllers;

use App\Http\Requests\Major\CreateMajorRequest;
use App\Http\Requests\Major\UpdateMajorRequest;
use App\Models\Student;
use App\Repositories\MajorRepository;
use Illuminate\Http\Request;

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
		$data = [];
		foreach ($major as $item) {
			$total_of_student = Student::where('major_id', $item['id'])->count();
			$item['total_student'] = $total_of_student;
			$data[] = $item;
		}
		return response()->json([
			'data'	=> $data,
		],200);
	}

	/**
	 * Get all major with trashed
	 * @return array
	 */
	public function listMajorWithTrashed() 
	{
		$major = $this->majorRepository->getMajorWithTrash();
		return response()->json([
			'data'	=> $major,
		],200);
	}

	/**
	 * Find major
	 * @param array $faculty_id
	 * @return array
	 */
	public function showList($faculty_id)
	{
		$major_list = $this->majorRepository->findByFaculty($faculty_id);
		return response()->json([
			'data'	=> $major_list,
		],200);
	}

	public function show($major_id)
	{
		$major = $this->majorRepository->find($major_id);
		return response()->json([
			'data'	=> $major,
		],200);
	}

	/**
	 * Create new student
	 * @return array
	 */
	public function store(CreateMajorRequest $request)
	{
		$data = $request->only(
			'name',
			'faculty_id',
		);
		$data['major_id'] = 'MaJor'. mt_rand(100, 100000);
		$this->majorRepository->create($data);
		
		return response()->json([$request->all()],201);
	}

	public function destroy(Request $request)
	{
		$delete = $this->majorRepository->delete($request->major_id);
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
		foreach($request->list as $student_id) {
			$delete = $this->majorRepository->delete($student_id);
			if(! $delete) {
				array_push($errors, $student_id);
			}
		}
		return response()->json([
			'errors' => $errors,
		],200);
	}

	/**
	 * Update major
	 * @return bool
	 */
	public function update(UpdateMajorRequest $request)
	{
		$data = $request->only(
			'id',
			'name',
			'faculty_id',
		);
		$update = $this->majorRepository->update($request->id, $data);

		if(! $update) {
			return response()->json([
				'status'=> false,
			],422);
		}
		return response()->json([
			'status' => true,
		],200);
	}
}
