<?php

namespace Sim\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PortfolioController extends Controller {

    public function indexAction() {
        return $this->forward('SimAdminBundle:Portfolio:list');
    }
    
    public function listAction() {
        $repository = $this->getDoctrine()->getRepository('SimCoreBundle:Article');
        /* @var $repository Sim\CoreBundle\Entity\ArticleRepository */
        $articles = $repository->getAll();
        
        return $this->render('SimAdminBundle:Portfolio:list.html.twig', array(
            'articles'  => $articles,
        ));
    }
    
    public function createAction() {
        $form = $this->createFormBuilder()
            ->add('title', 'text')
            ->add('subtitle', 'text')
            ->add('content', 'textarea')
            ->add('visible', 'checkbox', array(
                'required'  => FALSE,
                'attr'      => array(
                    'checked'   => TRUE,
                ),
            ))
            ->getForm();
        
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->bind($request);
            
            if ($form->isValid()) {
                $data = $form->getData();
                $article = new \Sim\CoreBundle\Entity\Article();
                $article->setTitle($data['title']);
                $article->setSlugFromString($data['title']);
                $article->setSubtitle($data['subtitle']);
                $article->setContent($data['content']);
                $article->setVisible($data['visible']);
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($article);
                $em->flush();
                
                return $this->redirect($this->generateUrl('sim_admin_portfolio_success'));
            }
        }
        
        return $this->render('SimAdminBundle:Portfolio:create.html.twig', array(
            'form'  => $form->createView(),
        ));
    }
    
    public function editAction($id) {
        $repository = $this->getDoctrine()->getRepository('SimCoreBundle:Article');
        /* @var $repository Sim\CoreBundle\Entity\ArticleRepository */
        
        $article = $repository->find($id);
        if (!$article) {
            throw $this->createNotFoundException('The project does not exist');
        }
        
        $form = $this->createFormBuilder($article)
            ->add('title', 'text')
            ->add('subtitle', 'text')
            ->add('content', 'textarea')
            ->add('visible', 'checkbox', array(
                'required'  => FALSE,
            ))
            ->getForm();
        
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->bind($request);
            
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($article);
                $em->flush();
                
                return $this->redirect($this->generateUrl('sim_admin_portfolio_success'));
            }
        }
        
        return $this->render('SimAdminBundle:Portfolio:edit.html.twig', array(
            'form'      => $form->createView(),
            'article'   => $article,
        ));
    }
    
    public function successAction() {
        return $this->render('SimAdminBundle:Portfolio:success.html.twig');
    }

}
