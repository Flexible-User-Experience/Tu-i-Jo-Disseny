<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Project;
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
            '::Front/projects/list.html.twig',
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

    /**
     * @Route("/projecte/{slug}/seguent", name="front_project_next")
     * @Method({"GET"})
     * @param $slug
     *
     * @return Response
     */
    public function nextProjectAction($slug)
    {
        $projects = $this->getDoctrine()->getRepository('AppBundle:Project')->findAllEnabledSortedByName();
        $project = $this->getDoctrine()->getRepository('AppBundle:Project')->findOneBy(
            [ 'slug' => $slug ]
        );
        /** @var Project $item */
        foreach ($projects as $i => $item) {
            if ($item->getSlug() == $project->getSlug()) {
                if (($i + 1) === count($projects)) {
                    $project = $projects[0];
                } else {
                    $project = $projects[$i + 1];
                }
                break;
            }
        }

        return $this->redirectToRoute('front_project_detail', ['slug' => $project->getSlug()]);
    }

    /**
     * @Route("/projecte/{slug}/anterior", name="front_project_prev")
     * @Method({"GET"})
     * @param $slug
     *
     * @return Response
     */
    public function prevProjectAction($slug)
    {
        $projects = $this->getDoctrine()->getRepository('AppBundle:Project')->findAllEnabledSortedByName();
        $project = $this->getDoctrine()->getRepository('AppBundle:Project')->findOneBy(
            [ 'slug' => $slug ]
        );
        /** @var Project $item */
        foreach ($projects as $i => $item) {
            if ($item->getSlug() == $project->getSlug()) {
                if ($i === 0) {
                    $project = $projects[(count($projects) - 1)];
                } else {
                    $project = $projects[$i - 1];
                }
                break;
            }
        }

        return $this->redirectToRoute('front_project_detail', ['slug' => $project->getSlug()]);
    }
}
