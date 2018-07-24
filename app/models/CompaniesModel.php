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
		var_dump($request);
		$sql = 'INSERT INTO companies (company_name, address, phone, kvk, contact_person, email) VALUES (:companyName, :address, :phone, :kvk, :contactPerson, :email)';
		$query = $pdo->prepare($sql);
		$query->execute([
			':companyName' => $request['companyName'],
			':address' => $request['address'],
			':phone' => $request['phone'],
			':kvk' => $request['kvk'],
			':contactPerson' => $request['contactPerson'],
			':email' => $request['email']
		]);
	}
}

?>