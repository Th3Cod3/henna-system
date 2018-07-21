<?php 

namespace App\Controllers;


class TwigController {

	protected $twigEng;

	public function __construct()
	{
		$loader = new \Twig_Loader_Filesystem('views');
		$this->twigEng = new \Twig_Environment($loader,[
			'debug' => true, 
			'cache' => false
		]);

		//for the dump function of TWIG
		$this->twigEng->addExtension(new \Twig_Extension_Debug());


		$this->twigEng->addFilter(new \Twig_SimpleFilter('url', function($path){
				return BASE_URL.$path;
		}));
	}

	public function render($fileName, $data = [])
	{
			return $this->twigEng->render($fileName,$data);
	}

}


?>