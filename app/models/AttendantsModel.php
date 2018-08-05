<?php 

namespace App\Models;

/**
 *  	j
 */
class AttendantsModel
{
	
	public function getAllFuntions()	
	{
		global $pdo;

		$sql = 'SELECT * FROM functions';
		$query = $pdo->query($sql);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getAttendantsByEvent($event_id)
	{
		global $pdo;

		$sql = 'SELECT * FROM event_registers AS er JOIN persons AS p ON p.person_id = er.person_id JOIN functions AS f ON er.register_as = f.function_id WHERE event_id = :event_id';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':event_id' => $event_id
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function saveAttendant($request)
	{
		global $pdo;

		$sql = 'INSERT INTO event_registers (register_as, event_id, person_id) VALUES (:register_as, :event_id, :person_id)';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':event_id' => $request['event_id'],
			':register_as' => $request['register_as'],
			':person_id' => $request['person_id']
		]);

		return $result;
	}

	public function checkAttendant($event_id, $person_id)
	{
		global $pdo;

		$sql = 'SELECT * FROM event_registers WHERE event_id = :event_id and person_id = :person_id';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':event_id' => $event_id,
			':person_id' => $person_id
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function removeAttendant($register_id)
	{
		global $pdo;

		$sql = 'DELETE FROM event_registers WHERE register_id = :register_id';

		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':register_id' => $register_id
		]);

		return $result;
	}
}


 ?>