<?php defined('SYSPATH') or die('No direct script access.');

class Model_Material
{	
	public function getMaterialsByCategory($category_id)
	{
		return DB::select()
			->from('materials')
			->where('category_id', '=', $category_id)
			->execute()
			->as_array();
	}
}