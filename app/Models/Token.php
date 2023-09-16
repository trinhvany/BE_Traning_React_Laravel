<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
	use HasFactory;
	protected $table = 'access_tokens';
	protected $fillable = [
		'token',
		'token_expried',
		'refresh_token',
		'refresh_token_expried',
		'student_id',
	];

	protected $hidden = ['refresh_token_expried'];
}
