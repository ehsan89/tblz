<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tabloz\UserBundle\Controller;

use Tabloz\UserBundle\Entity\User;

use Imagine\Gd\Imagine;

use Imagine\Image\Box;

use Imagine\Image\Point;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Factory\UtilityBundle\Utils\Util;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\FOSUserEvents;
use Sonata\UserBundle\Controller\ProfileController as BaseController;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends BaseController
{
	/**
	 * @Route("/upload_user_image", name="upload_user_image")
	 * @Template()
	 * 
	 * @param Request $request
	 * @throws Exception
	 */
	public function uploadUserImageAction(Request $request) {
		$editId = $request->get('editId');
		if (!$editId)
		{
			throw new Exception("Bad edit id");
		}

		$fileUploader = $this->get('punk_ave.file_uploader');
		Util::recursive_remove_dir('uploads/users/tmp/images/' . $editId);
		//$fileUploader->removeFiles(array('folder' => 'events/tmp/images/' . $editId));
		$fileUploader->handleFileUpload(array(
				'folder' => 'users/tmp/images/' . $editId, 
				'sizes' => array(
// 						'xss' => array(
// 								'folder' => 'xss', 
// 								'max_width' => 20, 
// 								'max_height' => 20
// 								), 
						'thumbnail' => array(
								'folder' => 'thumbnail', 
			                    'max_width' => 400,
			                    'max_height' => 400
			                ))));
		
	}
	
	/**
	 * @Route("/crop_user_image", name="crop_user_image")
	 * @Template()
	 * 
	 * @param Request $request
	 * @throws Exception
	 */
	public function cropUserImageAction(Request $request) {
		$util = $this->container->get('util');
		if( !$util->isAuthenticated() ){
			throw new AccessDeniedException();
		}
		
		$x1 = $request->get('x1');
		$y1 = $request->get('y1');
		$x2 = $request->get('x2');
		$y2 = $request->get('y2');
		
		$user = $this->get('security.context')->getToken()->getUser();
		$editId = sha1($user->getId());
		
		$dir = scandir('uploads/users/tmp/images/' . $editId . '/thumbnail', 1);
		$filepath = 'uploads/users/tmp/images/' . $editId . '/thumbnail/'.$dir[0];
		
		$imagine = new Imagine();
		$image = $imagine->open($filepath);
		$image->crop(new Point($x1, $y1), new Box( abs($x2-$x1), abs($y2-$y1)))
		->save($filepath);
		
		$mediaManager = $this->get('sonata.media.manager.media');
		$media = $mediaManager->create();
		$media->setBinaryContent($this->get('kernel')->getRootDir() . '/../web/' . $filepath);
		$media->setContext('user'); // video related to the user
		$media->setProviderName('sonata.media.provider.image');
		$mediaManager->save($media);
		
		$user->setImage($media);
		$em = $this->getDoctrine()->getManager();
		$em->persist($user);
		$em->flush();

		Util::recursive_remove_dir('uploads/users/tmp/images/' . $editId);
		
	}
	
	/**
	 * @Route("/delete_user_image", name="delete_user_image")
	 * @Template()
	 * 
	 * @param Request $request
	 * @throws Exception
	 */
	public function deleteUserImageAction(Request $request) {
		$util = $this->container->get('util');
		if( !$util->isAuthenticated() ){
			throw new AccessDeniedException();
		}
		$user = $util->getCurrentUser();

		$mediaRepository = $this->getDoctrine()
		->getRepository('ApplicationSonataMediaBundle:Media');
		$default_image = $mediaRepository->findOneByName('default-user-image');
		$user_image = $user->getImage();
		if ($user->getImage()->getId() != $default_image->getId()){
			
			$user->setImage($default_image);
			
			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();

			$mediaManager = $this->get('sonata.media.manager.media');
			$mediaManager->delete($user_image);
		}
		
	}

    /**
     * @return Response
     *
     * @throws AccessDeniedException
     */
    public function editProfileAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        
		// upload user image things...
		$editId = sha1($user->getId());

        $form = $this->container->get('sonata.user.profile.form');
        $formHandler = $this->container->get('sonata.user.profile.form.handler');

        $process = $formHandler->process($user);
        if ($process) {

        	//$editId = $request->query->get('editId');
        	if ($editId && is_dir('uploads/users/tmp/images/' . $editId . '/originals')) {
        		$tmpfiles = scandir('uploads/users/tmp/images/' . $editId . '/originals', 1);
        		$file_name = $tmpfiles[0];
        		
        		//$event->setImagePath($file_name);
        		// 					$fileUploader = $this->get('punk_ave.file_uploader');
        		// 					$tmpfiles = $fileUploader->getFiles(array('folder' => 'events/tmp/images/' . $editId . '/originals'));
        	}
        	
            $this->setFlash('fos_user_success', 'profile.flash.updated');

            //return new RedirectResponse($this->generateUrl('sonata_user_profile_show'));
        }

        return $this->render('TablozUserBundle:Profile:edit_profile.html.twig', array(
            'form' => $form->createView(),
            'editId' => $editId,
        		
        ));
    }
	
	/**
	 * @Route("/header_user_image", name="header_user_image")
	 * @Template()
	 * 
	 * @param Request $request
	 */
	public function HeaderUserImageAction(Request $request) {
		$util = $this->container->get('util');
		if( !$util->isAuthenticated() ){
			throw new AccessDeniedException();
		}
	}

    /**
     * @Route("/people/{username}", name="user_portfolio")
     * @ParamConverter("user", class="TablozUserBundle:User")
     * @Template()
     */
    public function userPortfolioAction(User $user){
		
    	return array(
    			'user' => $user
    			);
    }

    /**
     * @Route("/people/{username}/tablos", name="user_portfolio_tablos")
     * @ParamConverter("user", class="TablozUserBundle:User")
     * @Template()
     */
    public function userPortfolioTablosAction(User $user, Request $request){

    	$page = $request->query->get('page');
    	
    	$repository = $this->getDoctrine()->getRepository('TablozMainBundle:Tablo');
    	
    	$query = $repository->createQueryBuilder('t')
    	->where('t.user = :user')->setParameter('user', $user)
    	->andwhere('t.private = 0')
    	->andwhere('t.enable = 1')
    	->orderBy('t.created_at', 'DESC')
    	->getQuery();
    	
    	$tablos = $query->getResult();
    	
    	return array(
    			'tablos' => $tablos
    			);
    }
}
