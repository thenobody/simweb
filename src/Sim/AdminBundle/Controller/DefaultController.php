<?php

namespace Sim\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->redirect($this->generateUrl('sim_admin_portfolio_list'));
    }

}
