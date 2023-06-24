<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/rest/films")
 */

class CinemaController
{

	public function __construct()
	{
		
	}


	/**
	 * @Route("/top-films",  methods={"GET"})
	 */
	public function getTopFilmsList()
	{
        var_dump('OLOLOLO');
	}	
}
