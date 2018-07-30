<?php 

namespace App\Models;

/**
 * 	a
 */
class PeopleModel
{
	public function addPerson($request)
	{
		global $pdo;

		$sql = 'INSERT INTO persons (address, phone, birthday, azv, firstname, lastname, birthplace, email, occupation) VALUES ( :address, :phone, :birthday, :azv, :firstname, :lastname, :birthplace, :email, :occupation)';

		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':address' => $request['address'], 
			':phone' => $request['phone'], 
			':birthday' => $request['birthday'], 
			':azv' => $request['azv'],
			':firstname' => $request['firstname'],
			':lastname' => $request['lastname'],
			':birthplace' => $request['birthplace'],
			':email' => $request['email'],
			':occupation' => $request['occupation']
		]);

		return ['result' => $result, 'id' => $pdo->lastInsertId()];
	}

	public function getAllPersons()	
	{
		global $pdo;

		$sql = "SELECT * FROM persons";
		$query = $pdo->query($sql);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getPerson($person_id)
	{
		global $pdo;

		$sql = "SELECT * FROM persons WHERE person_id = :person_id";
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':person_id' => $person_id 
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}
}

 ?>