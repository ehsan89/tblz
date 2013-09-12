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
    	$util = $this->container->get('util');
    	$current_user = $util->getCurrentUser();
    	$user = $tablo->getUser();
    	
		$fav_users = $tablo->getFavoriteUsers();
		$is_fav_user = false;
    	
    	$following = 0;
    	$util = $this->container->get('util');
    	if( $util->isAuthenticated() ){
	    	$current_user = $util->getCurrentUser();
	    	
	    	$repository = $this->getDoctrine()->getRepository('TablozUserBundle:UserFollow');
	    	 
	    	$query = $repository->createQueryBuilder('f')
	    	->select('count(f.id)')
	    	->where('f.follower = :follower')->setParameter('follower', $current_user)
	    	->andwhere('f.followee = :followee')->setParameter('followee', $user)
	    	->getQuery();
	    	 
	    	$following = $query->getSingleScalarResult();
	    	
			foreach ($fav_users as $u) {
				if ($u->getId() == $current_user->getId()) {
					$is_fav_user = true;
					break;
				}
			}
    	}
		return array(
				'tablo' => $tablo,
				'is_fav_user' => $is_fav_user,
				'fav_users' => $fav_users
		);
	}
	
	/**
	 * @Route("/tablo/comment/{id}", name="tablo_comment", requirements={"id" = "\d+"})
     * @ParamConverter("tablo", class="TablozMainBundle:Tablo")
	 * @Template()
	 */
	public function tabloCommentAction(Tablo $tablo) {
		$form = $this->createForm(new TabloCommentType());
		
		$comments = $tablo->getComments();
		
		return array('comments' => $comments,
				'tablo' => $tablo,
				'form' => $form->createView());
	
	}

	/**
	 * @Route("/add_tablo_comment/{id}", name="add_tablo_comment", requirements={"id" = "\d+"})
     * @ParamConverter("tablo", class="TablozMainBundle:Tablo")
	 * @Template()
	 * 
	 * @param Request $request
	 */
	public function addTabloCommentAction(Tablo $tablo, Request $request) {
		$util = $this->container->get('util');
		if( !$util->isAuthenticated() ){
			throw new AccessDeniedException();
		}
		$em = $this->getDoctrine()->getManager();
		$user= $util->getCurrentUser();
		$form = $this->createForm(new TabloCommentType());
		
		if ($request->isMethod('POST')) {
			$form->bind($request);
		
			if ($form->isValid()) {
				// perform some action, such as saving the task to the database
				$comment = $form->getData();
				$comment->setTablo($tablo);
				$comment->setUser($user);
				$em->persist($comment);
				
				$tablo->setCommentCount($tablo->getCommentCount() + 1);
				$em->persist($tablo);
				
				$em->flush();
			}
			
			return $this->render(
					'TablozMainBundle:Default:tablo_comment_view.html.twig',
					array('comment' => $comment)
			);
		}
	}
	
	/**
	 * @Route("/favorite_tablo/{id}", name="favorite_tablo")
     * @ParamConverter("tablo", class="TablozMainBundle:Tablo")
	 */
	public function favoriteTabloAction(Tablo $tablo) {
    	$util = $this->container->get('util');
    	if( !$util->isAuthenticated() ){
    		throw new AccessDeniedException();
    	}
    	$current_user = $util->getCurrentUser();
    	$tablo->addFavoriteUser($current_user);
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($tablo);
    	$em->flush();
    	
    	return new Response('success');
	}
	
	/**
	 * @Route("/unfavorite_tablo/{id}", name="unfavorite_tablo")
     * @ParamConverter("tablo", class="TablozMainBundle:Tablo")
	 */
	public function unfavoriteTabloAction(Tablo $tablo) {
    	$util = $this->container->get('util');
    	if( !$util->isAuthenticated() ){
    		throw new AccessDeniedException();
    	}
    	$current_user = $util->getCurrentUser();
    	$tablo->removeFavoriteUser($current_user);
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($tablo);
    	$em->flush();
		
    	return new Response('success');
	}

	/**
	 * @Route("/tablo_tell_friend/{id}", name="tablo_tell_friend", requirements={"id" = "\d+"})
     * @ParamConverter("tablo", class="TablozMainBundle:Tablo")
	 * @Template()
	 * 
	 * @param Request $request
	 */
	public function tellFriendAction(Tablo $tablo, Request $request) {
		$util = $this->container->get('util');
		$user= $util->getCurrentUser();
		$tell_friend = new TabloTellFriend();
		$tell_friend->setTablo($tablo);
		if( $util->isAuthenticated() ){
    		$user = $util->getCurrentUser();
			$tell_friend->setFromName($user->getFullname());
			$tell_friend->setFromEmail($user->getEmail());
		}
		$success = false;
		$em = $this->getDoctrine()->getManager();
		$form = $this->createForm(new TabloTellFriendType(), $tell_friend);
		
		if ($request->isMethod('POST')) {
			$form->bind($request);
		
			if ($form->isValid()) {
				$success = true;
				// perform some action, such as saving the task to the database
				$tell_friend = $form->getData();
				$tell_friend->setTablo($tablo);
				if( $util->isAuthenticated() ){
					$tell_friend->setFromName($user->getFullname());
					$tell_friend->setFromEmail($user->getEmail());
				}
				$em->persist($tell_friend);
				
				$em->flush();
				
				// TODO: uncomment sending email and test mail template	
				//sending email
				/*$message = \Swift_Message::newInstance()
				->setSubject($tablo->getTitle().' اثری از '.$tablo->getUser()->getFullname().' در '.'tabloz.com')
				->setFrom($tell_friend->getFromEmail())
				->setTo($tell_friend->getToEmail())
				->setBody(
						$this->renderView(
								'TablozMainBundle:Default:tablo_tell_friend_mail_template.html.twig',
								array('tell_friend' => $tell_friend, 'tablo' => $tablo)
						)
				)
				;
				$this->get('mailer')->send($message);
				*/
			}
		}
		return array('form' => $form->createView(), 'tablo' => $tablo, 'success' => $success);
	}
}
