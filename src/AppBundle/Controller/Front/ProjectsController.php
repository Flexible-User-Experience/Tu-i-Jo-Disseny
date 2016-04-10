<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProjectsController
 *
 * @category Controller
 * @package  AppBundle\Controller\Front
 * @author   David Romaní <david@flux.cat>
 */
class ProjectsController extends Controller
{
    /**
     * @Route("/projectes", name="front_projects")
     * @Method({"GET"})
     */
    public function projectsAction()
    {
        return $this->render(
            '::Front/projects.list.html.twig',
            [ 'projects' => $this->getDoctrine()->getRepository('AppBundle:Project')->findAllEnabledSortedByName() ]
        );
    }

    /**
     * @Route("/projecte/{slug}", name="front_project_detail")
     * @Method({"GET"})
     * @param $slug
     *
     * @return Response
     */
    public function projectAction($slug)
    {
        $project = $this->getDoctrine()->getRepository('AppBundle:Project')->findOneBy(
            [ 'slug' => $slug ]
        );

        return $this->render(
            '::Front/projects/detail.html.twig',
            [ 'project' => $project ]
        );
    }
}
