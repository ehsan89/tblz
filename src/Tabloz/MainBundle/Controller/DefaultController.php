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
	 * @Route("/tablos", name="tablos")
	 * 
	 * @Template()
	 */
	public function tablosAction(Request $request) {
		$category = $request->query->get('category');

		$repository = $this->getDoctrine()->getRepository('TablozMainBundle:TabloCategory');
		$categories = $repository->createQueryBuilder('c')
		->where('c.enable = 1')
		->orderBy('c.title', 'DESC')
		->getQuery()->getResult();
		
		$repository = $this->getDoctrine()->getRepository('TablozMainBundle:Tablo');
		$query = $repository->createQueryBuilder('t');
		if ($category && $category != 'all') {
			$query->innerJoin('t.category', 'tc', 'WITH', 'tc.descriptor = :descriptor')->setParameter('descriptor', $category);
		}
    	$query = $query->getQuery();
    	 
    	$tablos = $query->getResult();
    	
    	return array(
    			'tablos' => $tablos,
    			'categories' => $categories
    			);
	}

	
	/**
	 * @Route("/tablo/{id}", name="view_tablo", requirements={"id" = "\d+"})
     * @ParamConverter("tablo", class="TablozMainBundle:Tablo")
	 * @Template()
	 */
	public function viewTabloAction(Tablo $tablo) {

	}
}
