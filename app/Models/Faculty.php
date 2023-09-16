<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = 'faculties';
	protected $fillable = [
		'name',
		'delete_at',
	];

	protected $hidden = ['created_at', 'deleted_at', 'updated_at', ];

}
