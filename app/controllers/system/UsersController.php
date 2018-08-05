<?php 

namespace App\Controllers\System;

use App\Controllers\TwigController;
use App\Models\PeopleModel;
use App\Models\UsersModel;
use Sirius\Validation\Validator;

/**
 * 	
 */
class UsersController extends TwigController
{
	
	public function getIndex()
	{
		
	}

	public function getDashboard()
	{
		if($_SESSION['permission'] > 1)
			header("Location:".BASE_URL."user/all");
		else
			header("Location:".BASE_URL."people/profile/".$_SESSION['person_id']);
	}

	public function getNew()
	{
		$peopleModel = new PeopleModel();
		$persons = $peopleModel->getAllPersons();

		return $this->render('user/new-user.twig', [
			'personsData' => $persons,
		]);
	}

	public function postNew()
	{
		$validator = new Validator();
		$validator->add('person_id','required');
		$validator->add('password','required');
		$validator->add('user','required');

		if($validator->validate($_POST)){
			$usersModel = new UsersModel();
			$exist = $usersModel->checkUserExist($_POST['user']);
			var_dump($exist);
			if(!$exist){
				if($_POST['password'] == $_POST['password2'])
					$create = $usersModel->createUser($_POST);
				else
					$validator->addMessage('password','The password does not match.');
			}
			else
				 $validator->addMessage('user','This user already exist.');
		}
		

		if(isset($create))
			header("Location:".BASE_URL."user/dashboard");
		else{
			$peopleModel = new PeopleModel();
			$persons = $peopleModel->getAllPersons();
			$errors = $validator->getMessages();
			return $this->render('user/new-user.twig', [
				'personsData' => $persons,
				'errors' => $errors
			]);
		}

	}

	public function getAll()
	{
		$usersModel = new UsersModel();
		$users = $usersModel->getAllUsers();

		return $this->render('user/users.twig', [
			'usersData' => $users
		]);
	}

}

 ?>