<?php 

namespace App\Controllers\System;

use App\Controllers\TwigController;
use App\Models\InvoicesModel;
use App\Models\CompaniesModel;
use App\Models\EventsModel;
/**
 * 	a
 */
class InvoicesController extends TwigController
{

	// incompleted
	public function getIndex($event_id)
	{
		$invoicesModel = new InvoicesModel();
		$invoiceData = $invoicesModel->getQuoteByEvent($event_id);



		foreach ($invoiceData as $key => $invoice) {
			$total = $invoicesModel->getTotal($invoice['invoice_id']);
				if($total[0]['total'])
					array_push($invoiceData[$key],$total[0]);
				else{
					array_push($invoiceData[$key],['total' => '0']);
				}
		}
		$totalBudget = $invoicesModel->getInvoicesTotal($event_id);
		var_dump($totalBudget);
		return $this->render('event/event-budget.twig', [
			'id' => $event_id, 
			'invoiceData' => $invoiceData, 
			'totalBudget' => $totalBudget[0]['total']
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
			'eventData' => $eventData[0],
			'action' => 'Add',
			'section' => 'Budget'

		]);
	}

	public function postAdd($event_id)
	{
		if($_POST['event_id'] == $event_id){
			$invoicesModel = new InvoicesModel;
			$created = $invoicesModel->createQuote($_POST);
			if($created['result'])
			{
				header("Location:".BASE_URL.'/budgets/items/'.$created['id']);
			}
		}
		else{
			return $this->getAdd($event_id);
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

		if($_POST['invoice_id'] == $budget_id){
			$invoicesModel = new InvoicesModel;
			$update = $invoicesModel->updateQuote($_POST);

			return $this->getItems($budget_id);
		}
	}

	public function getItems($budget_id)
	{
		$invoicesModel = new invoicesModel();
		$companiesModel = new CompaniesModel();

		$invoicesData = $invoicesModel->getQuote($budget_id);
		$company_id = $invoicesData[0]['company_id'];
		$event_id = $invoicesData[0]['event_id'];

		$productsData = $companiesModel->getProducts($company_id);
		$itemsData = $invoicesModel->getItems($budget_id);

		$total = $invoicesModel->getTotal($budget_id);
		return $this->render('event/event-budget-item.twig', [
			'budget_id' => $budget_id, 
			'company_id' => $company_id,
			'productsData' => $productsData,
			'itemsData' => $itemsData,
			'total' => $total[0]['total'], 
			'event_id' => $event_id
		]);
	}

	public function postItems($budget_id)
	{
		$invoicesModel = new invoicesModel();
		$save = $invoicesModel->saveItem($_POST);
		var_dump($save);
		return $this->getItems($budget_id);
	}

}

 ?>