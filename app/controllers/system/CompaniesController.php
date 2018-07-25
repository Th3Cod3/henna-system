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
		return $this->render('layout.twig');
	}
	
	public function getAdd()
	{
		return $this->render('company/new-company.twig');
	}

	public function postAdd()
	{
		$companiesModel = new CompaniesModel();
		$save = $companiesModel->addCompany($_POST);
		header("Location:".BASE_URL."companies");
	}

	public function getAddproduct($comapny_id)
	{
		return $this->render('layout.twig');
	}

}

?>