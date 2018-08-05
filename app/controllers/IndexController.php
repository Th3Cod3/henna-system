<?php 

namespace App\Controllers;

use App\Models\UsersModel;
use Sirius\Validation\Validator;

class IndexController extends TwigController
{
	public function getIndex()
	{
		header("Location:".BASE_URL."login");
	}

	public function getLogin()
	{
		return $this->render('login.twig', [
			'delnav' => true
		]);
	}

	public function postLogin()
	{
		$validator = new Validator();
		$usersModel = new UsersModel();
		$validator->add('user', 'required');
    $validator->add('password', 'required');

    if($validator->validate($_POST)){
    	$userInfo = $usersModel->checkUserExist($_POST['user']);
	    if($userInfo){
	    	if(password_verify($_POST['password'], $userInfo['password'])){
	    		$_SESSION['user_id'] = $userInfo['user_id'];
	    		$_SESSION['user'] = $userInfo['user'];
	    		$_SESSION['firstname'] = $userInfo['firstname'];
	    		$_SESSION['lastname'] = $userInfo['lastname'];
	    		$_SESSION['gender'] = $userInfo['gender'];
	    		$_SESSION['permission'] = $userInfo['permission'];
	    		$_SESSION['person_id'] = $userInfo['person_id'];

	    		header("Location:".BASE_URL."events");
	    		return null;
	    	}
	    }
    	$validator->addMessage('Error','Username and/or password does not match');
    }
    $errors = $validator->getMessages();

		return $this->render('login.twig', [
			'delnav' => true, 
			'errors' => $errors
		]);
	}

		public function getLogout()
	{
		session_destroy();
		header("Location:".BASE_URL."login");
	}
	
}

?>