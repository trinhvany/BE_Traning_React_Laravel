<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Student extends ResourceCollection
{
	/**
	 * Transform the resource collection into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
	 */
	public function toArray($request)
	{
		return [
			'data' => $this->collection
			// 'id'			=> $this->id,
			// 'student_id'	=> $this->student_id,
			// 'phone'			=> $this->phone,
			// 'address'		=> $this->address,
			// 'email'			=> $this->email,
			// 'major_id'		=> $this->major_id,
			// 'gender'		=> $this->gender,
			// 'birthday'		=> $this->birthday,
			// 'name'			=> $this->name,
		];
	}
}
