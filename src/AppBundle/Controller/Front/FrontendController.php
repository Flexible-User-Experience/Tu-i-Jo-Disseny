<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class FrontendController
 *
 * @category Controller
 * @package  AppBundle\Controller\Front
 * @author   David Romaní <david@flux.cat>
 */
class FrontendController extends Controller
{
    /**
     * @Route("/", name="front_homepage")
     * @Method({"GET"})
     */
    public function homepageAction()
    {
        $projects = $this->getDoctrine()->getRepository('AppBundle:Project')->findAllEnabledAndShowInHomepageSortedByDate();

        return $this->render('::Front/homepage.html.twig', [ 'projects' => $projects ]);
    }

    /**
     * @Route("/blog/", name="front_blog")
     * @Method({"GET"})
     */
    public function blogAction()
    {
        return $this->render(
            '::Front/blog.list.html.twig',
            array(
                'tags' => $this->getDoctrine()->getRepository('AppBundle:BlogTag')->findAllEnabledSortedByName(),
            )
        );
    }
}
