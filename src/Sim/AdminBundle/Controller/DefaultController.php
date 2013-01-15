<?php

namespace Sim\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SimAdminBundle:Default:index.html.twig', array('name' => $name . '-admin'));
    }
}
