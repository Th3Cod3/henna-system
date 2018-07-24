<?php 

namespace App\Controllers\System;

use App\Controllers\TwigController;
use App\Models\EventsModel;

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
			'action' => 'new'
		]);
	}

	public function postNew()
	{
		$eventsModel = new EventsModel();
		$save = $eventsModel->createEvent($_POST);
		header("Location:".BASE_URL."events");
	}

	public function getEdit($id)
	{
		$eventsModel = new EventsModel();
		$data = $eventsModel->getEvent($id);

		return $this->render('event/new-event.twig', [
			'button' => 'Save',
			'action' => 'save',
			'data' => $data
		]);
	}

	public function postEdit($id)
	{
		if($_POST['id'] == $id)
		{
			$eventsModel = new EventsModel();
			$data = $eventsModel->saveEvent($_POST);
			header("Location:".BASE_URL."events");
		}
		/*
		return $this->render('event/new-event.twig', [
			'button' => 'Save',
			'action' => 'save',
			'data' => $data
		]);*/
	}

	public function getDelete($id)
	{
		$eventsModel = new EventsModel();
		$delete = $eventsModel->deleteEvent($id);
		header("Location:".BASE_URL."events");
	}

	public function getManage($id)
	{
		$eventsModel = new EventsModel();
		$data = $eventsModel->getEvent($id);
		return $this->render('event/manage.twig',[
			'data' => $data
		]);
	}

	public function getBudget($id)
	{
		return $this->render('event/event-budget.twig', ['id' => $id]);
	}
	
	public function getAddbudget($id)
	{
		return $this->render('event/event-budget-add.twig', ['id' => $id]);
	}

	public function getCost($id)
	{
		return $this->render('event/event-cost.twig', ['id' => $id]);
	}

	public function getAddcost($id)
	{
		return $this->render('event/event-cost-add.twig', ['id' => $id]);
	}
}

?>