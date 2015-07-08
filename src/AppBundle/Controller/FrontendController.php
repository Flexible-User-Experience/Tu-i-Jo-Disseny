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
        return $this->render('::Front/services.list.html.twig');
    }

    /**
     * @Route("/projects", name="front_projects")
     */
    public function projectsAction()
    {
        return $this->render('::Front/projects.list.html.twig');
    }
}
