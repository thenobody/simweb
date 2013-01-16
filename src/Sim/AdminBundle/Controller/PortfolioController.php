<?php

namespace Sim\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PortfolioController extends Controller {

    public function indexAction() {
        return $this->forward('SimAdminBundle:Portfolio:list');
    }
    
    public function listAction() {
        return $this->render('SimAdminBundle:Portfolio:list.html.twig');
    }

}
