<?php 

namespace App\Models;

/**
 * 				
 */
class InvoicesModel
{
	
	public function createQuote($request)
	{
		global $pdo;
		//need to proces the invoice_file
		$sql = "INSERT INTO invoices (invoice_no, invoice_date, event_id, company_id, invoice_type, invoice_status ) VALUES (:invoice_no, :invoice_date, :event_id, :company_id, 0, 0)";
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':invoice_no' => $request['invoice_no'], 
			':invoice_date' => $request['invoice_date'], 
			':event_id' => $request['event_id'], 
			':company_id' => $request['company_id']
		]);

		return ['result' => $result, 'id' => $pdo->lastInsertId()];

	}

	public function getQuoteByEvent($event_id)
	{
		global $pdo;

		$sql = 'SELECT * FROM invoices WHERE event_id = :id';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':id' => $event_id
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getItems($invoice_id)
	{
		global $pdo;

		$sql = 'SELECT * FROM invoice_items as i
			JOIN products as p
			ON p.product_id = i.product_id
			WHERE invoice_id = :id';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':id' => $invoice_id
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getQuote($invoice_id)
	{
		global $pdo;

		$sql = 'SELECT * FROM invoices WHERE invoice_id = :id';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':id' => $invoice_id
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function saveItem($request)
	{
		global $pdo;

		$sql = 'INSERT INTO invoice_items (invoice_id, product_id, price, amount) VALUES (:invoice_id, :product_id, :price, :amount)';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':invoice_id' => $_POST['invoice_id'],
			':price' => $_POST['price'],
			':product_id' => $_POST['product_id'],
			':amount' => $_POST['amount']
		]);

		return $result;
	}

	public function updateQuote($request)
	{
		global $pdo;

		$sql = 'UPDATE invoices SET invoice_no = :invoice_no, invoice_date = :invoice_date, event_id = :event_id, company_id = :company_id WHERE invoice_id = :invoice_id';

		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':invoice_no' => $request['invoice_no'], 
			':invoice_date' => $request['invoice_date'], 
			':event_id' => $request['event_id'], 
			':company_id' => $request['company_id'],
			':invoice_id' => $request['invoice_id']
		]);

		return $result;
	}
}

 ?>