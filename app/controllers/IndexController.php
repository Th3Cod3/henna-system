<?php 

namespace App\Controllers;


class IndexController extends TwigController
{
	public function getIndex()
	{
		header("Location:".BASE_URL."events");
	}
	
}

?>