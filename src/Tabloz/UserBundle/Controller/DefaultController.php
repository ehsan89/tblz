<?php

namespace Tabloz\UserBundle\Controller;

use Tabloz\UserBundle\Form\Type\TabloType;
use Tabloz\MainBundle\Entity\Tablo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Factory\UtilityBundle\Utils\Util;
use Imagine\Gd\Imagine;

/**
 * @Route("/user")
 */
class DefaultController extends Controller
{
	/**
	 * @Route("/upload_new_work", name="upload_new_work")
	 * @Template()
	 * 
	 * @param Request $request
	 */
    public function uploadNewWorkAction(Request $request)
    {
    	$editId = $request->get('editId');
    	if (!$editId)
    	{
    		throw new Exception("Bad edit id");
    	}
    	
    	$fileUploader = $this->get('punk_ave.file_uploader');
    	Util::recursive_remove_dir('uploads/tablos/tmp/images/' . $editId);
    	//$fileUploader->removeFiles(array('folder' => 'events/tmp/images/' . $editId));
    	$fileUploader->handleFileUpload(array(
    			'folder' => 'tablos/tmp/images/' . $editId,
    			'sizes' => array(
    					'thumbnail' => array(
    							'folder' => 'thumbnail',
    							'max_width' => 700,
    							'max_height' => 700
    					))));
        
    }

    /**
	 * @Route("/add_new_work", name="add_new_work")
	 * @Template()
	 * 
	 * @param Request $request
     *
     * @throws AccessDeniedException
     */
    public function addNewWorkAction(Request $request)
    {
    	$util = $this->container->get('util');
        
    	$user = $util->getCurrentUser();
    	
		$tablo = new Tablo();
		$form = $this->createForm(new TabloType());
		
		// upload tablo image things...
		$editId = sha1($user->getId());
		
		if ($request->isMethod('POST')) {
			$form->bind($request);
		
			if ($form->isValid()) {
				// perform some action, such as saving the task to the database
				$tablo = $form->getData();
		
				$tablo->setUser($user);
		
				ini_set('memory_limit', '-1');
				$dir = scandir('uploads/tablos/tmp/images/' . $editId . '/originals', 1);
				$filepath = 'uploads/tablos/tmp/images/' . $editId . '/originals/'.$dir[0];
				
				$mediaManager = $this->get('sonata.media.manager.media');
				$media = $mediaManager->create();
				$media->setBinaryContent($this->get('kernel')->getRootDir() . '/../web/' . $filepath);
				$media->setContext('tablo'); // image related to the tablo
				$media->setProviderName('sonata.media.provider.tablo');
				$mediaManager->save($media);
				
				$tablo->setImage($media);
				$em = $this->getDoctrine()->getManager();
				$em->persist($tablo);
				$em->flush();
		
				Util::recursive_remove_dir('uploads/tablos/tmp/images/' . $editId);
				
				return $this->redirect($this->generateUrl('edit_tablo', array('id' => $tablo->getId())));
			}
		}

        return array(
            'form' => $form->createView(),
            'editId' => $editId,
       	);
    }

    /**
     * @Route("/tablo/{id}/edit", name="edit_tablo", requirements={"id" = "\d+"})
     * @ParamConverter("tablo", class="TablozMainBundle:Tablo")
     * @Template()
     *
     * @param Request $request
     */
    public function editTabloAction(Tablo $tablo, Request $request){
		$form = $this->createForm(new TabloType(), $tablo);

		if ($request->isMethod('POST')) {
			$form->bind($request);
		
			if ($form->isValid()) {
				// perform some action, such as saving the task to the database
				$em = $this->getDoctrine()->getManager();
				$em->persist($tablo);
				$image = $tablo->getImage();
				$em->persist($image);
				$em->flush();
			}
		}
		
    	return array(
    			'tablo' => $tablo,
    			'form' => $form->createView()
    			);
    }

    /**
     * @Route("/manage_works", name="manage_works")
     * @Template()
     *
     * @param Request $request
     */
    public function manageWorksAction(Request $request){
    	$util = $this->container->get('util');
    	$user = $util->getCurrentUser();
    	
    	$tablos = $this->getDoctrine()
        ->getRepository('TablozMainBundle:Tablo')
        ->findByUser($user);
    	
    	return array(
    			'tablos' => $tablos
    			);
    }

    /**
     * @Route("/tablo/toggle_private", name="toggle_tablo_private")
     *
     * @param Request $request
     */
    public function toggleTabloPrivateAction(Request $request){

		if ($request->isMethod('POST')) {
			
	    	$private = $request->request->get('private');
	    	$id = $request->request->get('id');
	    	
   			$em = $this->getDoctrine()->getManager();

		    $tablo = $em->getRepository('TablozMainBundle:Tablo')->find($id);
	        
		    if (!$tablo) {
		        throw $this->createNotFoundException('The tablo does not exist');
		    }
		    
		    $tablo->setPrivate(($private==1)?true:false);
			
			$em->flush();
			
			return new Response($tablo->getId().'success');
		}
		
		return new Response('fail');
    }
}
