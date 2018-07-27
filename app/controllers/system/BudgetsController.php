<?php 

namespace App\Controllers\System;

use App\Controllers\TwigController;
use App\Models\InvoicesModel;
use App\Models\CompaniesModel;
use App\Models\EventsModel;
/**
 * 	a
 */
class BudgetsController extends TwigController
{

	// incompleted
	public function getIndex($event_id)
	{
		$invoicesModel = new InvoicesModel();
		$invoiceData = $invoicesModel->getQuoteByEvent($event_id);

		foreach ($invoiceData as $key => $invoice) {
			$itemsData = $invoicesModel->getItems($invoice['invoice_id']);
			array_push($invoiceData[$key],['items' => [ $itemsData ]]);
		}

		return $this->render('event/event-budget.twig', [
			'id' => $event_id, 
			'invoiceData' => $invoiceData
		]);
	}

		public function getAdd($event_id)
	{
		$eventsModel = new EventsModel();
		$eventData = $eventsModel->getEvent($event_id);

		$companiesModel = new CompaniesModel;
		$companiesData = $companiesModel->getAllCompanies();
		return $this->render('event/event-budget-add.twig', [
			'id' => $event_id, 
			'companiesData' => $companiesData,
			'eventData' => $eventData,
			'action' => 'Add',
			'section' => 'Budget'

		]);
	}

	public function postAdd($event_id)
	{
		if($_POST['event_id'] == $event_id){
			$invoicesModel = new InvoicesModel;
			$create = $invoicesModel->createQuote($_POST);

			if($create['result'])
				header("Location:".BASE_URL.'/events/additem/'.$create['id']);
		}
	}

	public function getEdit($budget_id)
	{
		$eventsModel = new eventsModel();
		
		$invoicesModel = new InvoicesModel();
		$invoiceData = $invoicesModel->getQuote($budget_id);
		$itemsData = $invoicesModel->getItems($budget_id);

		$eventData = $eventsModel->getEvent($invoiceData[0]['event_id']);
		$companiesModel = new CompaniesModel();
		$companiesData = $companiesModel->getAllCompanies();

		return $this->render('event/event-budget-add.twig', [
			'id' => $budget_id, 
			'companiesData' => $companiesData,
			'eventData' => $eventData[0],
			'invoiceData' => $invoiceData[0],
			'items' => $itemsData,
			'action' => 'Edit',
			'section' => 'Budget'
		]);
	}

	public function postEdit($budget_id)
	{

		var_dump($_POST);
		if($_POST['invoice_id'] == $budget_id){
			$invoicesModel = new InvoicesModel;
			$create = $invoicesModel->updateQuote($_POST);

			// if($create['result'])
			// 	header("Location:".BASE_URL.'/events/additem/'.$create['id']);
		}
	}

	public function getItems($budget_id)
	{
		$invoicesModel = new invoicesModel();
		$companiesModel = new CompaniesModel();

		$invoicesData = $invoicesModel->getQuote($budget_id);
		$company_id = $invoicesData[0]['company_id'];

		$productsData = $companiesModel->getProducts($company_id);
		$itemsData = $invoicesModel->getItems($budget_id);

		return $this->render('event/event-budget-item.twig', [
			'budget_id' => $budget_id, 
			'company_id' => $company_id,
			'productsData' => $productsData,
			'itemsData' => $itemsData
		]);
	}

	public function postItems($budget_id)
	{
		$invoicesModel = new invoicesModel();
		$save = $invoicesModel->saveItem($_POST);
		var_dump($save);
		if($save)
			header("Location:".BASE_URL."events/additem/".$budget_id);
	}


}

 ?>