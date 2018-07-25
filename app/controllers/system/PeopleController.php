<?php

namespace App\Controllers\System;

use App\Controllers\TwigController;

/**
 * 	
 */
class PeopleController extends TwigController
{
	
		public function getIndex()
		{
			return $this->render('layout.twig');
		}
}

?>