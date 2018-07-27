<?php

namespace App\Controllers\System;

use App\Controllers\TwigController;
use App\Models\PeopleModel;
/**
 * 	
 */
class PeopleController extends TwigController
{
	
		public function getIndex()
		{
			$peopleModel = new PeopleModel();
			$personsData = $peopleModel->getAllPerson();

			return $this->render('people/people.twig', [
				'personsData' => $personsData
			]);
		}

		public function getNew()
		{
			return $this->render('people/new-person.twig',[
				'button' => 'Add'
			]);
		}

		public function postNew()
		{
			$peopleModel = new PeopleModel();
			$save = $peopleModel->addPerson($_POST);


			if($save['result'])
				header("Location:".BASE_URL.'profile/'.$save['id']);
		}

		public function getProfile($person_id)
		{
			return $this->render('people/profile.twig');
		}
}

?>