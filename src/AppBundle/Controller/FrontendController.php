<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class FrontendController
 *
 * @category Controller
 * @package  AppBundle\Controller
 * @author   David Romaní <david@flux.cat>
 */
class FrontendController extends Controller
{
    /**
     * @Route("/", name="front_homepage")
     */
    public function homepageAction()
    {
        return $this->render('::Front/homepage.html.twig');
    }

    /**
     * @Route("/services", name="front_services")
     */
    public function servicesAction()
    {
        return $this->render(
            '::Front/services.list.html.twig',
            array(
                'categories' => $this->getDoctrine()->getRepository(
                    'AppBundle:ServiceCategory'
                )->findAllEnabledSortedByName(),
            )
        );
    }

    /**
     * @Route("/projects", name="front_projects")
     */
    public function projectsAction()
    {
        return $this->render(
            '::Front/projects.list.html.twig',
            array(
                'projects' => $this->getDoctrine()->getRepository('AppBundle:Project')->findAllEnabledSortedByName(),
            )
        );
    }

    /**
     * @Route("/partners", name="front_partners")
     */
    public function partnersAction()
    {
        return $this->render('::Front/partners.list.html.twig', array(
            'partners' => $this->getDoctrine()->getRepository('AppBundle:Partner')->findAllEnabledSortedByName(),
        ));
    }

    /**
     * @Route("/blog", name="front_blog")
     */
    public function blogAction()
    {
        return $this->render('::Front/blog.list.html.twig');
    }
}
