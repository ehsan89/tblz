<?php
namespace Application\Sonata\MediaBundle\Security;

use Tabloz\MainBundle\Entity\TabloRepository;

use Sonata\MediaBundle\Security\DownloadStrategyInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TabloDownloadStrategy implements DownloadStrategyInterface
{
    protected $container;

    protected $translator;

    protected $tablo_repo;

    /**
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @param TabloRepository $tablo_repo
     */
    public function __construct(TranslatorInterface $translator, ContainerInterface $container, TabloRepository $tablo_repo)
    {
        $this->tablo_repo    = $tablo_repo;
        $this->container = $container;
        $this->translator = $translator;
    }

    /**
     * @param \Sonata\MediaBundle\Model\MediaInterface $media
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return bool
     */
    public function isGranted(MediaInterface $media, Request $request)
    {
    	$util = $this->container->get('util');
    	$user= $util->getCurrentUser();
    	if( $util->isAuthenticated() ){
    		$tablo = $this->tablo_repo->findOneByImage($media);
    		if ($tablo && $tablo->getUser()->getId() == $user->getId()){
    			return true;
    		}
    	}
    	
    	return false;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
    	return 'تنها صاحب اثر امکان دانلود فایل اصلی را دارد.'; 
        //return $this->translator->trans('description.tablo_download_strategy', array('%times%' => $this->times), 'SonataMediaBundle');
    }
    
}