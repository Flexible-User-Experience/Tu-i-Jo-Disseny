<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\BlogPost;
use AppBundle\Entity\ContactNewsletter;
use AppBundle\Form\Type\BlogNewsletterType;
use Doctrine\ORM\EntityNotFoundException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @param string  $year
     * @param string  $month
     * @param string  $day
     * @param string  $slug
     *
     * @return Response
     * @throws EntityNotFoundException
     */
    public function projectAction(Request $request, $year, $month, $day, $slug)
    {
        $date = \DateTime::createFromFormat('Y-m-d', $year . '-' . $month . '-' . $day);
        /** @var BlogPost $post */
        $post = $this->getDoctrine()->getRepository('AppBundle:BlogPost')->findOneBy(
            [
                'publishedAt' => $date,
                'slug'        => $slug,
            ]
        );
        if (!$post) {
            throw new EntityNotFoundException();
        }
        $tags = $this->getDoctrine()->getRepository('AppBundle:BlogTag')->getPostTagsSortedByTitle($post);
        $post->setTags($tags);

        $flash = null;
        $newsletter = new ContactNewsletter();
        $form = $this->createForm(BlogNewsletterType::class, $newsletter);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // persist entity
            $cnm = $this->get('app.contact_newsletter_manager');
            $persistedNewsletter = $cnm->fetchOrCreateNewRecord($newsletter);
            $em = $this->getDoctrine()->getManager();
            $em->persist($persistedNewsletter);
            $em->flush();
            // send notifications
            $messenger = $this->get('app.notification');
            $messenger->sendNewsletterUserNotification($persistedNewsletter);
            // reset form
            $newsletter = new ContactNewsletter();
            $form = $this->createForm(BlogNewsletterType::class, $newsletter);
            // build flash message
            $flash = 'revisa el correu, has de verificar la teva bústia per rebre el newsletter';
        }

        return $this->render(
            ':Front/blog:detail.html.twig',
            [
                'post'      => $post,
                'blog_form' => $form->createView(),
                'flash'     => $flash,
            ]
        );
    }
}
