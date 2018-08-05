<?php 

namespace App\Models;

/**
 * a
 */
class UsersModel
{
	public function createUser($request)
	{
		global $pdo;

		$sql = 'INSERT INTO users (user, password, person_id, permission) VALUES (:user, :password, :person_id, 1)';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':user' => $request['user'],
			':person_id' => $request['person_id'],
			':password' => password_hash($request['password'], PASSWORD_DEFAULT)
		]);

		return $result;

	}	

	public function checkUserExist($user)
	{
			global $pdo;

		$sql = 'SELECT * FROM users AS u JOIN persons AS p ON u.person_id = p.person_id WHERE user = :user';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':user' => $user,
		]);

		return $query->fetch(\PDO::FETCH_ASSOC);
	}

	public function getAllUsers()
	{
			global $pdo;

		$sql = 'SELECT * FROM users AS u JOIN persons AS p ON u.person_id = p.person_id';
		$query = $pdo->query($sql);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}
}

 ?>