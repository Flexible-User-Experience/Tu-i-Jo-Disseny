<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\ContactMessage;
use AppBundle\Form\Type\ContactMessageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @param Request $request
     *
     * @return Response
     */
    public function homepageAction(Request $request)
    {
        $gms = $this->get('app.google_maps_service');
        $mapObject = $gms->buildMap(40.7097791, 0.5786492, 18);
        $projects = $this->getDoctrine()->getRepository(
            'AppBundle:Project'
        )->findAllEnabledAndShowInHomepageSortedByPosition();
        $services = $this->getDoctrine()->getRepository('AppBundle:Service')->findAllEnabledSortedByPosition();
        $contact = new ContactMessage();
        $form = $this->createForm(ContactMessageType::class, $contact);
//        $newsletter = new ContactNewsletter();
//        $formNewsletter = $this->createForm(ContactNewsletterType::class, $newsletter);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // persist entity
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            // send notifications
            $messenger = $this->get('app.notification');
            $messenger->sendUserNotification($contact);
            $messenger->sendAdminNotification($contact);
            // reset form
            $contact = new ContactMessage();
            $form = $this->createForm(ContactMessageType::class, $contact);
            // build flash message
            $this->addFlash('msg', 'frontend.form.flash.user');
        }

        return $this->render(
            '::Front/homepage.html.twig',
            [
                'mapView'      => $mapObject,
                'projects'     => $projects,
                'services'     => $services,
                'contact_form' => $form->createView(),
//                'newsletter_form' => $formNewsletter->createView(),
            ]
        );
    }

    /**
     * @Route("/blog", name="front_blog")
     * @Method({"GET"})
     */
    public function blogAction()
    {
        return $this->render(
            '::Front/blog.list.html.twig',
            [
                'tags' => $this->getDoctrine()->getRepository('AppBundle:BlogTag')->findAllEnabledSortedByName(),
            ]
        );
    }
}
