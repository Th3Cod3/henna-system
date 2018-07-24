<?php 

namespace App\Models;

/**
 * 			
 */		
class EventsModel
{	
	
	public function activeEvent()
	{
		global $pdo;

		$objDate = new \DateTime();
		$today = $objDate->format('');

		$sql = 'SELECT * FROM events';
		$query = $pdo->query($sql);

		$result = $query->fetchAll(\PDO::FETCH_ASSOC);
		return $result;

	}

	public function createEvent($request)
	{
		global $pdo;

		$sql = "INSERT INTO events (name, description, event_date, place) VALUES (:eventName, :description, :eventDate, :place)";
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':eventName' => $request['eventName'],
			':description' => $request['description'],
			':eventDate' => $request['eventDate'],
			':place' => $request['place']
		]);

		//$result = $query->fetchAll(\PDO::FETCH_ASSOC);

		
		return $result;
	}

	public function saveEvent($request)
	{
		global $pdo;

		$sql = "UPDATE events SET name = :eventName, description = :description, event_date = :eventDate, place = :place WHERE id = :id";
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':eventName' => $request['eventName'],
			':description' => $request['description'],
			':eventDate' => $request['eventDate'],
			':place' => $request['place'],
			':id' => $request['id']
		]);

		//$result = $query->fetchAll(\PDO::FETCH_ASSOC);

		
		return $result;
	}

	public function getEvent($id)
	{
		global $pdo;

		$sql = "SELECT * FROM events WHERE id = :id";
		$query = $pdo->prepare($sql);
		$query->execute([
			':id' => $id
		]);
		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function deleteEvent($id)
	{
		global $pdo;

		$sql = "DELETE FROM events WHERE id = :id";
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':id' => $id
		]);
		return $result;
	}
}

?>