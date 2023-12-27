<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login', 'register']]);
	}

	/**
	 * Get a JWT via given credentials.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(Request $request)
	{
		$request->validate([
			'email' => 'required|string|email',
			'password' => 'required|string',
		]);
		$credentials = $request->only('email', 'password');

		if (!$token = auth('api')->attempt($credentials)) {
			return response()->json(['error' => 'Unauthorized'], 401);
		}

		$user = Auth::user();
		return $this->createNewToken($token);
	}

	public function register(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6',
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		$token = Auth::login($user);
		return response()->json([
			'status' => 'success',
			'message' => 'User created successfully',
			'user' => $user,
			'authorization' => [
				'token' => $token,
				'type' => 'bearer',
			]
		]);
	}

	/**
	 * Log the user out (Invalidate the token).
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		Auth::logout();
		return response()->json([
			'status'	=> 'success',
			'message'	=> 'Successfully logged out',
		]);
	}

	/**
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function refresh(Request $request)
	{
		$refresh_token =$request->bearerToken();
		$check = Token::where('refresh_token', $refresh_token)
						->whereDate('refresh_token_expried', '>=', Carbon::now()->format('Y-m-d H:i:s'))
						->get();
		if ($check) {
			return $this->createNewToken(auth('api')->refresh());
		}
		Auth::guard('api')->logout();
		return "Logout successs";
	}

	/**
	 * Get the authenticated User.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function userProfile()
	{
		return response()->json(auth()->user());
	}

	/**
	 * Get the token array structure.
	 *
	 * @param  string $token
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function createNewToken($token)
	{
		$check = Token::where('student_id', auth('api')->id())->first();
		$refresh_token = Str::random(120);
		if(! $check) {
			Token::create([
				'token'					=> $token,
				'token_expried'			=> Carbon::now()->addMinute(3)->format('Y-m-d H:i:s'),
				'refresh_token'			=> $refresh_token,
				'refresh_token_expried'	=> Carbon::now()->addMonth(1)->format('Y-m-d H:i:s'),
				'student_id' 			=> auth('api')->id(),
			]);
		} else {
			$check->token 					= $token;
			$check->token_expried 			= Carbon::now()->addMinute(3)->format('Y-m-d H:i:s');
			$check->refresh_token 			= $refresh_token;
			$check->refresh_token_expried	= Carbon::now()->addMonth(1)->format('Y-m-d H:i:s');
			$check->save();
		}
		
		return response()->json([
			'access_token' 		=> $token,
			'token_expires_in'	=> Carbon::now()->addMinute(3)->format('Y-m-d H:i:s'),
			'refresh_token' 	=> $refresh_token,
			'user' 				=> auth('api')->user(),
			'status' 			=> true,
		]);
	}
}
