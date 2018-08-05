<?php  

namespace App\Models;



/**
 * 
 */
class CompaniesModel
{
	public function addCompany($request)
	{
		global $pdo;
		$sql = 'INSERT INTO companies (company_name, address, phone, kvk, contact_person, email) VALUES (:companyName, :address, :phone, :kvk, :contactPerson, :email)';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':companyName' => $request['companyName'],
			':address' => $request['address'],
			':phone' => $request['phone'],
			':kvk' => $request['kvk'],
			':contactPerson' => $request['contactPerson'],
			':email' => $request['email']
		]);

		return $result;
	}

	public function getAllCompanies()
	{
		global $pdo;

		$sql = "SELECT * FROM companies";
		$query = $pdo->query($sql);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getItems($invoice_id)
	{
		global $pdo;

		$sql = 'SELECT 
			*
			FROM invoice_items as i
			JOIN products AS p
			ON i.product_id = p.invoice_items
			WHERE invoice_id = :invoice_id';

		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':invoice_id' => $invoice_id
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function saveInvoiceItem($request)
	{
		
	}

	public function saveProduct($request)
	{
		global $pdo;
		$sql = 'INSERT INTO products (description, name, company_id, code) VALUES (:description, :name, :company_id, :code)';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':description' => $request['description'],
			':name' => $request['name'],
			':company_id' => $request['company_id'],
			':code' => $request['code']
		]);

		return $result;
	}

	public function getProducts($company_id)
	{
		global $pdo;

		$sql = 'SELECT 	*	FROM products WHERE company_id = :company_id';

		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':company_id' => $company_id
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);

	}
}

?>