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
			$personsData = $peopleModel->getAllPersons();

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
			$profilePic = \saveProfilePic($_FILES,$save['id']);
			if($profilePic)
				$savePic = $peopleModel->saveProfilePic($profilePic,$save['id']);

			if($save['result'])
				return $this->getProfile($save['id']);
		}

		public function getDelete($person_id)
		{
			$peopleModel = new PeopleModel();
			$delete = $peopleModel->deletePerson($person_id);

			return $this->getIndex();
		}

		public function getProfile($person_id)
		{
			$peopleModel = new PeopleModel();
			$person = $peopleModel->getPerson($person_id);

			return $this->render('people/profile.twig', [
				'person' => $person[0]
			]);
		}
		
}

?>