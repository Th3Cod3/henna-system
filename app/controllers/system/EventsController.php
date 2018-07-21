<?php 

namespace App\Controllers\System;

use App\Controllers\TwigController;

class EventsController extends TwigController
{
	public function getIndex()
	{
		return $this->render('events.twig');
	}

	public function getNew()
	{
		return $this->render('new-event.twig');
	}
	
}

?>