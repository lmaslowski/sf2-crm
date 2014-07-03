<?php

namespace Crm\CrmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CrmCrmBundle:Default:index.html.twig', array('name' => $name));
    }
}
