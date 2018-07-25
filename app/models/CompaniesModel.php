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
		//var_dump($request);
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

	public function getItems($id)
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
			':invoice_id' => $id
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function saveInvoiceItem($request)
	{
		
	}

	public function saveProduct($id)
	{
		# code...
	}
}

?>