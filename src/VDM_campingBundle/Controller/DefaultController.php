<?php

namespace VDM_campingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VDM_campingBundle:Default:index.html.twig');
    }
}
