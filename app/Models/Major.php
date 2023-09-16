<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = 'majors';
	protected $fillable = [
		'name',
		'faculty_id',
		'delete_at',
	];

	protected $hidden = [ 'created_at', 'deleted_at', 'updated_at', ];

}
