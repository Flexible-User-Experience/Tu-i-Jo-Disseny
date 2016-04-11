<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @Method({"GET"})
     */
    public function blogListAction()
    {
        return $this->render(
            ':Front/blog:list.html.twig',
            [
                'tags'  => $this->getDoctrine()->getRepository('AppBundle:BlogTag')->findAllEnabledSortedByName(),
                'posts' => $this->getDoctrine()->getRepository('AppBundle:BlogPost')->findAllEnabledSortedByName(),
            ]
        );
    }

    /**
     * @Route("/blog/{slug}", name="front_blog_posts_detail")
     * @Method({"GET"})
     * @param $slug
     *
     * @return Response
     */
    public function projectAction($slug)
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
