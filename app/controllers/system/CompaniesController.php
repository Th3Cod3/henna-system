<?php 

namespace App\Controllers\System;

use App\Controllers\TwigController;
use App\Models\CompaniesModel;

/**
 * 
 */
class CompaniesController extends TwigController
{
	public function getIndex()
	{
		$companiesModel = new CompaniesModel();
		$companiesData = $companiesModel->getAllCompanies();

		return $this->render('company/company.twig', [
			'companiesData' => $companiesData
		]);

	}
	
	public function getNew()
	{
		return $this->render('company/new-company.twig');
	}

	public function postNew()
	{
		$companiesModel = new CompaniesModel();
		$save = $companiesModel->addCompany($_POST);
		header("Location:".BASE_URL."companies");
	}

	public function getProducts($company_id)
	{
		$companiesModel = new CompaniesModel();
		$productsData = $companiesModel->getProducts($company_id);
		return $this->render('company/add-product.twig', [ 
			'company_id' => $company_id, 
			'productsData' => $productsData
		]);
	}

	public function postProducts($company_id)
	{
		$companiesModel = new CompaniesModel();
		$save = $companiesModel->saveProduct($_POST);

		header("Location:".BASE_URL."companies/products/".$company_id);
	}

}

?>