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
			'action' => 'new'
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

	public function postEdit($event_id)
	{
		if($_POST['id'] == $event_id)
		{
			$eventsModel = new EventsModel();
			$data = $eventsModel->saveEvent($_POST);
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
// incompleted
	public function getBudgets($event_id)
	{

		$invoicesModel = new InvoicesModel();
		$invoiceData = $invoicesModel->getQuoteByEvent($event_id);

		foreach ($invoiceData as $key => $invoice) {
			$itemsData = $invoicesModel->getItems($invoice['invoice_id']);
			array_push($invoiceData[$key],['items' => [ $itemsData ]]);
			//var_dump($invoice);
		}

		return $this->render('event/event-budget.twig', [
			'id' => $event_id, 
			'invoiceData' => $invoiceData
		]);
	}
	
	public function getAddbudget($event_id)
	{
		$eventsModel = new EventsModel();
		$eventData = $eventsModel->getEvent($event_id);

		$companiesModel = new CompaniesModel;
		$companiesData = $companiesModel->getAllCompanies();
		return $this->render('event/event-budget-add.twig', [
			'id' => $event_id, 
			'companiesData' => $companiesData,
			'eventData' => $eventData
		]);
	}

	public function getAdditem($budget_id)
	{

		$invoicesModel = new invoicesModel();
		$invoicesData = $invoicesModel->getQuote($budget_id);
			//var_dump($invoicesData);
			$company_id = $invoicesData[0]['company_id'];
		return $this->render('event/event-budget-item.twig', [
			'id' => $budget_id, 
			'company_id' => $company_id
		]);
	}

	public function postAddbudget($event_id)
	{
		if($_POST['event_id'] == $event_id){
			$invoicesModel = new InvoicesModel;
			$create = $invoicesModel->createQuote($_POST);

			if($create['result'])
				header("Location:".BASE_URL.'/events/additem/'.$create['id']);
		}
	}



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