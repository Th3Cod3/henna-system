<?php 

namespace App\Controllers\System;

use App\Controllers\TwigController;
use App\Models\EventsModel;
use App\Models\CompaniesModel;
use App\Models\InvoicesModel;
use App\Models\AdminModel;
use App\Models\PeopleModel;
use App\Models\AttendantsModel;

class EventsController extends TwigController
{
	public function getIndex()
	{
		$eventsModel = new EventsModel();
		$activeEvent = $eventsModel->activeEvent();
		return $this->render('event/events.twig',[
			'activeEvent' => $activeEvent
		]);
	}

	public function getNew()
	{
		return $this->render('event/new-event.twig', [
			'button' => 'Create',
			'action' => 'New'
		]);
	}

	public function postNew()
	{
		$eventsModel = new EventsModel();
		$save = $eventsModel->createEvent($_POST);
		header("Location:".BASE_URL."events");
	}

	public function getEdit($event_id)
	{
		$eventsModel = new EventsModel();
		$data = $eventsModel->getEvent($event_id);

		return $this->render('event/new-event.twig', [
			'button' => 'Save',
			'action' => 'save',
			'data' => $data,
			'event_id' => $event_id
		]);
	}

	public function postEdit($event_id)
	{
		if($_POST['event_id'] == $event_id)
		{
			$eventsModel = new EventsModel();
			$data = $eventsModel->saveEvent($_POST);
			return $this->getIndex();
		}
	}

	public function getDelete($event_id)
	{
		$eventsModel = new EventsModel();
		$delete = $eventsModel->deleteEvent($event_id);
		
		return $this->getIndex();
	}
// incompleted
	public function getManage($event_id)
	{
		$eventsModel = new EventsModel();
		$eventData = $eventsModel->getEvent($event_id);

		$invoicesModel = new InvoicesModel();
		$totalBudget = $invoicesModel->getInvoicesTotal($event_id);
		
		$attendantsModel = new AttendantsModel();
		$functions = $attendantsModel->getAllFuntions();
		$attendants = $attendantsModel->getAttendantsByEvent($event_id);

		$peopleModel = new PeopleModel();
		$persons = $peopleModel->getAllPersons();



		return $this->render('event/manage.twig',[
			'eventData' => $eventData[0],
			'totalBudget' => $totalBudget[0]['total'],
			'functions' => $functions, 
			'persons' => $persons, 
			'attendants' => $attendants

		]);
	}

	public function postManage($event_id)
	{
		if($event_id == $_POST['event_id'])
		{
			$attendantsModel = new AttendantsModel();
			$exist = $attendantsModel->checkAttendant($_POST['event_id'],$_POST['person_id']);
			if(!$exist)
				$save = $attendantsModel->saveAttendant($_POST);
		}

		return $this->getManage($event_id);
	}

	public function getRemove_attendant($event_id, $register_id)
	{
		$attendantsModel = new AttendantsModel();
		$remove = $attendantsModel->removeAttendant($register_id);

		return $this->getManage($event_id);

	}

//cost
	public function getCost($event_id)
	{
		return $this->render('event/event-budget.twig', ['id' => $event_id]);
	}

	public function getAddcost($event_id)
	{
		return $this->render('event/event-budget-add.twig', ['id' => $event_id]);
	}
}

?>