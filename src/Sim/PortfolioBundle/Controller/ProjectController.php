<?php

namespace Sim\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectController extends Controller {

    public function indexAction($name) {
        return $this->redirect($this->generateUrl('sim_admin_portfolio_list'));
    }

    public function projectAction($slug) {
        return $this->render('SimPortfolioBundle:Default:index.html.twig', array('slug' => $slug));
    }

}
