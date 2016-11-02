<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlogController
 *
 * @category Controller
 * @package  AppBundle\Controller\Front
 * @author   David Romaní <david@flux.cat>
 */
class BlogController extends Controller
{
    /**
     * @Route("/blog", name="front_blog_posts_list")
     */
    public function blogListAction()
    {
        return $this->render(
            ':Front/blog:list.html.twig',
            [
                'tags'  => $this->getDoctrine()->getRepository('AppBundle:BlogTag')->findAllEnabledSortedByName(),
                'posts' => $this->getDoctrine()->getRepository('AppBundle:BlogPost')->getAllEnabledSortedByPublishedDateWithJoinUntilNow(),
            ]
        );
    }

    /**
     * @Route("/blog/{year}/{month}/{day}/{slug}", name="front_blog_posts_detail")
     *
     * @param $slug
     *
     * @return Response
     */
    public function projectAction($year, $month, $day, $slug)
    {
        $post = $this->getDoctrine()->getRepository('AppBundle:BlogPost')->findOneBy(
            [ 'slug' => $slug ]
        );

        return $this->render(
            ':Front/blog:detail.html.twig',
            [ 'post' => $post ]
        );
    }
}
