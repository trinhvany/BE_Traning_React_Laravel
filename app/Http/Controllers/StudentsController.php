<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\CreateStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Repositories\StudentRepository;
use App\Services\StudentService;

class StudentsController extends Controller
{
	protected $studentRepository;

	/**
	 * Construct
	 */
	public function __construct(StudentRepository $studentRepository)
	{
		$this->studentRepository = $studentRepository;
	}

	/**
	 * Create new student
	 * @return array
	 */
	public function store(CreateStudentRequest $request)
	{
		$data = $request->only(
			'name',
			'student_id',
			'email',
			'password',
			'address',
			'phone',
			'faculty_id',
			'major_id',
			'gender',
			'birthday',
		);
		$data['student_id'] = 'SV'. mt_rand(100, 100000);
		$data['password'] = bcrypt($request->password);
		$this->studentRepository->create($data);
		
		return response()->json([$request->all()],201);
	}

	/**
	 * Update student
	 * @return bool
	 */
	public function update(UpdateStudentRequest $request)
	{
		$data = $request->only(
			'name',
			'address',
			'phone',
			'faculty_id',
			'major_id',
			'gender',
			'birthday',
		);
		$update = $this->studentRepository->update($request->id, $data);

		if(! $update) {
			return response()->json([
				'status'=> false,
			],422);
		}
		return response()->json([
			'status' => true,
		],200);
	}

	public function index()
	{
		$student_list = $this->studentRepository->getAll();

		return response()->json([
			'data' => $student_list,
		],200);
	}

	public function show($id)
	{
		$student = $this->studentRepository->find($id);
		return response()->json([
			'data' => $student,
		],200);
	}

	public function destroy(Request $request)
	{
		$delete = $this->studentRepository->delete($request->student_id);
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
			$delete = $this->studentRepository->delete($student_id);
			if(! $delete) {
				array_push($errors, $student_id);
			}
		}
		return response()->json([
			'errors' => $errors,
		],200);
	}
}
