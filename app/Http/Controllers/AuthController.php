<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\LoginRequest;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login', 'register', 'refresh']]);
	}

	/**
	 * Get a JWT via given credentials.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(LoginRequest $request)
	{
		$credentials = $request->only('email', 'password');

		if (!$token = auth('api')->attempt($credentials)) {
			return response()->json(['error' => 'Unauthorized'], 401);
		}

		return $this->createNewToken($token);
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
		$refresh_token = $request->refresh_token;
		$check = Token::where('refresh_token', $refresh_token)
						->whereDate('refresh_token_expried', '>=', Carbon::now()->format('Y-m-d H:i:s'))
						->get();
		if ($check) {
			return $this->createNewToken(auth('api')->refresh(), $refresh_token);
		}
		Auth::guard('api')->logout();
		return "Logout successs";
	}

	/**
	 * Get the token array structure.
	 *
	 * @param  string $token
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function createNewToken($token, $refresh_token = null)
	{
		if(is_null($refresh_token)) {
			$refresh_token_new = Str::random(120);
			Token::create([
				'token'					=> $token,
				'token_expried'			=> Carbon::now()->addMinute(1)->format('Y-m-d H:i:s'),
				'refresh_token'			=> $refresh_token_new,
				'refresh_token_expried'	=> Carbon::now()->addMonth(1)->format('Y-m-d H:i:s'),
				'student_id' 			=> auth('api')->id() ,
			]);
		} else {
			$check = Token::where('refresh_token', $refresh_token)->first();
			$check->token 					= $token;
			$check->token_expried 			= Carbon::now()->addMinute(1)->format('Y-m-d H:i:s');
			$check->refresh_token_expried	= Carbon::now()->addMonth(1)->format('Y-m-d H:i:s');
			if (is_null($refresh_token)) {
				$refresh_token_new = Str::random(120);
				$check->refresh_token = $refresh_token_new;
			}
			$check->save();
		}

		return response()->json([
			'access_token' 		=> $token,
			'token_expires_in'	=> Carbon::now()->addMinute(1)->format('Y-m-d H:i:s'),
			'refresh_token' 	=> is_null($refresh_token) ? $refresh_token_new : $refresh_token,
			'status' 			=> true,
		]);
	}
}
