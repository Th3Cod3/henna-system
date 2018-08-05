<?php 

namespace App\Models;

/**
 * 				
 */
class InvoicesModel
{
	
	public function createQuote($request, $invoice_file)
	{
		global $pdo;
		//need to proces the invoice_file
		$sql = "INSERT INTO invoices (invoice_no, invoice_date, event_id, company_id, invoice_type, invoice_status, invoice_file ) VALUES (:invoice_no, :invoice_date, :event_id, :company_id, :invoice_file, 0, 0)";
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':invoice_no' => $request['invoice_no'], 
			':invoice_date' => $request['invoice_date'], 
			':event_id' => $request['event_id'], 
			':company_id' => $request['company_id'],
			'invoice_file' => $invoice_file
		]);

		return ['result' => $result, 'id' => $pdo->lastInsertId()];

	}

	public function deleteInvoice($invoice_id)
	{
		global $pdo;

		$sql = 'DELETE FROM invoices WHERE invoice_id = :invoice_id';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':invoice_id' => $invoice_id, 
		]);

		$sql = 'DELETE FROM invoice_items WHERE invoice_id = :invoice_id';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':invoice_id' => $invoice_id, 
		]);


	}

	public function getQuoteByEvent($event_id)
	{
		global $pdo;

		$sql = 'SELECT c.company_name, i.* FROM invoices as i JOIN companies AS c ON i.company_id = c.company_id  WHERE event_id = :id';
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

		$sql = 'SELECT * FROM invoices as i JOIN companies AS c ON i.company_id = c.company_id WHERE invoice_id = :id';
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

		public function getTotal($invoice_id)
	{
		global $pdo;

		$sql = "SELECT SUM(price*amount) as total FROM invoice_items WHERE invoice_id = :invoice_id";
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':invoice_id' => $invoice_id
		]);
		
		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getInvoicesTotal($event_id, $invoice_type = 0)
	{
		global $pdo;

		$sql = "SELECT sum(amount*price) as total FROM invoices AS i JOIN invoice_items AS ii ON ii.invoice_id = i.invoice_id WHERE i.invoice_type = :invoice_type and i.event_id = :event_id";
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':event_id' => $event_id,
			'invoice_type' => $invoice_type
		]);
		
		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

}

 ?>