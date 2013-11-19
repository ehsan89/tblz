<?php

namespace Tabloz\MainBundle\Controller;

use Tabloz\MainBundle\Form\Type\TabloTellFriendType;

use Tabloz\MainBundle\Entity\TabloTellFriend;

use Tabloz\MainBundle\Form\Type\TabloCommentType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Tabloz\MainBundle\Entity\Tablo;
use Factory\UtilityBundle\Utils\Util;
use Factory\UtilityBundle\Utils\DateUtil;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class SearchController extends Controller
{

	
	/**
	 * @Route("/search/ajax", name="ajax_search")
	 * 
	 * @Template()
	 */
	public function ajaxSearchAction(Request $request) {
		$text = $request->request->get('text');
		$tablo_repository = $this->getDoctrine()->getRepository('TablozMainBundle:Tablo');
		$tablos = $tablo_repository->search($text, 'all', 'latest', 6);
		$collection_repository = $this->getDoctrine()->getRepository('TablozMainBundle:TabloCollection');
		$collections = $collection_repository->search($text, 'latest', 6);
		$user_repository = $this->getDoctrine()->getRepository('TablozUserBundle:User');
		$users = $user_repository->search($text, 'latest', 6);
    	
    	return array(
    			'tablos' => $tablos,
    			'collections' => $collections,
    			'users' => $users
    			);

	}
}
