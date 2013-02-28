<?php

namespace Sim\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('SimPortfolioBundle:Default:index.html.twig');
    }

}
