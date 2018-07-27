<?php 

namespace App\Controllers\System;

use App\Controllers\TwigController;
use App\Models\EventsModel;
use App\Models\CompaniesModel;
use App\Models\InvoicesModel;

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
			'data' => $data
		]);
	}

	public function postEdit($budget_id)
	{
		if($_POST['budget_id'] == $budget_id)
		{
			$eventsModel = new EventsModel();
			$data = $eventsModel->saveEvent($_POST);
			if($data)
				header("Location:".BASE_URL."events");
		}
	}

	public function getDelete($event_id)
	{
		$eventsModel = new EventsModel();
		$delete = $eventsModel->deleteEvent($event_id);
		if($delete)
			header("Location:".BASE_URL."events");
	}
// incompleted
	public function getManage($event_id)
	{
		$eventsModel = new EventsModel();
		$data = $eventsModel->getEvent($event_id);
		return $this->render('event/manage.twig',[
			'data' => $data
		]);
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