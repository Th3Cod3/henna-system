<?php 

namespace App\Controllers\System;

use App\Controllers\TwigController;
use App\Models\CompaniesModel;

/**
 * 
 */
class CompaniesController extends TwigController
{
	
public function getAdd()
{
	return $this->render('company/new-company.twig');
}

public function postAdd()
{
	$companiesModel = new CompaniesModel();
	var_dump($_POST);
	
	//$save = $companiesModel->addCompany($_POST);

}

}

?>