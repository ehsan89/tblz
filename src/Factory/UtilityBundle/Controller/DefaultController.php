<?php

namespace Factory\UtilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FactoryUtilityBundle:Default:index.html.twig', array('name' => $name));
    }
}
