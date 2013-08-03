<?php

namespace Tabloz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Factory\UtilityBundle\Utils\Util;
use Factory\UtilityBundle\Utils\DateUtil;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{

	
	/**
	 * @Route("/", name="tabloz_main_homepage")
	 * 
	 * @Template()
	 */
	public function homeAction(Request $request) {

	}

	
	/**
	 * @Route("/tablo/{id}", name="view_tablo", requirements={"id" = "\d+"})
     * @ParamConverter("tablo", class="TablozMainBundle:Tablo")
	 * @Template()
	 */
	public function viewTabloAction(Tablo $tablo) {

	}
}
