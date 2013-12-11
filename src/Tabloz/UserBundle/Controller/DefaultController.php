<?php

namespace Tabloz\UserBundle\Controller;

use Tabloz\MainBundle\Entity\TabloCollectionRepository;

use Tabloz\MainBundle\Entity\TabloCollection;

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

    	$print_type_repo = $this->getDoctrine()->getRepository('TablozMainBundle:PrintType');
    	$print_types = $print_type_repo->findByEnable(true);

    	$download_type_repo = $this->getDoctrine()->getRepository('TablozMainBundle:DownloadType');
    	$download_types = $download_type_repo->findByEnable(true);
		
    	return array(
    			'tablo' => $tablo,
    			'form' => $form->createView(),
    			'print_types' => $print_types,
    			'download_types' => $download_types
    			);
    }

    /**
     * @Route("/tablo/{id}/delete", name="delete_tablo", requirements={"id" = "\d+"})
     * @ParamConverter("tablo", class="TablozMainBundle:Tablo")
     */
    public function deleteTabloAction(Tablo $tablo, Request $request){
    	$util = $this->container->get('util');
    	$user = $util->getCurrentUser();
    	
    	if ($user != $tablo->getUser()) {
    		throw new AccessDeniedException();
    	}

    	$em = $this->getDoctrine()->getManager();
		$em->remove($tablo);
		$em->flush();
		
		if ($request->isXmlHttpRequest()) {
			return new Response('delete success');
		}
		
    	return $this->redirect($this->generateUrl('manage_works'));
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
    
    /**
     * @Route("/collection/new", name="new_tablo_collection")
     * @Template()
     *
     * @param Request $request
     */
    public function newTabloCollectionAction(Request $request)
    {
    	// just setup a fresh $task object (remove the dummy data)
    	$collection = new TabloCollection();
    
    	$form = $this->createFormBuilder($collection)
    	->add('title', null, array('attr' => array('placeholder' => 'عنوان مجموعه جدید')))
    	->add('private', null, array('required' => false))
    	->getForm();
    
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
		    $em = $this->getDoctrine()->getManager();
	    	$util = $this->container->get('util');
	    	$user = $util->getCurrentUser();
		    $collection->setUser($user);
		    $em->persist($collection);
		    $em->flush();
    
    		return array('form' => $form->createView(), 'collection' => $collection);
    	}
    
    	return array('form' => $form->createView());
    }
    
    /**
     * @Route("/tablo/{id}/add_to_collection", name="add_tablo_to_collection", requirements={"id" = "\d+"})
     * @ParamConverter("tablo", class="TablozMainBundle:Tablo")
     * @Template()
     *
     * @param Request $request
     */
    public function addTabloToCollectionAction(Tablo $tablo, Request $request)
    {
    	// just setup a fresh $task object (remove the dummy data)
    	$collection = new TabloCollection();
    
    	$form = $this->createFormBuilder($tablo)
    	->add('tablo_collections', null, array('expanded' => true, 'query_builder' => function(TabloCollectionRepository $er) {
			    return $er->createQueryBuilder('c')
			    ->where('c.enable = 1')->orderBy('c.created_at', 'DESC');
			}))
    	->getForm();
    
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
		    $em = $this->getDoctrine()->getManager();
		    $em->persist($tablo);
		    $em->flush();
    	}
    
    	return array('form' => $form->createView(), 'tablo' => $tablo);
    }

    /**
     * @Route("/manage_collections", name="manage_collections")
     * @Template()
     *
     * @param Request $request
     */
    public function manageCollectionsAction(Request $request){
    	$util = $this->container->get('util');
    	$user = $util->getCurrentUser();
    	
    	$collections = $this->getDoctrine()
        ->getRepository('TablozMainBundle:TabloCollection')
        ->findBy(
        		array('user'=> $user),
        		array('id' => 'DESC')
        );
    	
    	return array(
    			'collections' => $collections
    			);
    }

    /**
     * @Route("/tablo_collection/{id}/delete", name="delete_tablo_collection", requirements={"id" = "\d+"})
     * @ParamConverter("tablo_collection", class="TablozMainBundle:TabloCollection")
     */
    public function deleteTabloCollectionAction(TabloCollection $tablo_collection){
    	$util = $this->container->get('util');
    	$user = $util->getCurrentUser();
    	
    	if ($user != $tablo_collection->getUser()) {
    		throw new AccessDeniedException();
    	}

    	$em = $this->getDoctrine()->getManager();
		$em->remove($tablo_collection);
		$em->flush();
		
    	return new Response('delete success');
    }
}
