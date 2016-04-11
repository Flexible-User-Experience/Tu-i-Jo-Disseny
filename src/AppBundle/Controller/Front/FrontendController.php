<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\ContactMessage;
use AppBundle\Entity\ContactNewsletter;
use AppBundle\Form\Type\ContactMessageType;
use AppBundle\Form\Type\ContactNewsletterType;
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
        $partners = $this->getDoctrine()->getRepository('AppBundle:Partner')->findAllEnabledSortedByPosition();
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
                'partners'     => $partners,
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
            '::Front/blog/list.html.twig',
            [
                'tags' => $this->getDoctrine()->getRepository('AppBundle:BlogTag')->findAllEnabledSortedByName(),
            ]
        );
    }

    /**
     * @Route("/newsletter-form", name="app_newsletter_form")
     * @param Request $request
     *
     * @return Response
     */
    public function newsletterAction(Request $request)
    {
        $flash = null;
        $newsletter = new ContactNewsletter();
        $form = $this->createForm(ContactNewsletterType::class, $newsletter);
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
            $form = $this->createForm(ContactNewsletterType::class, $newsletter);
            // build flash message
            $flash = 'revisa el correu, has de verificar la teva bústia per rebre el newsletter';
        }

        return $this->render(
            ':Front/includes:newsletter-contact-form.html.twig',
            [
                'newsletter_form' => $form->createView(),
                'flash'           => $flash
            ]
        );
    }

    /**
     * @Route("/newsletter-form/confirmation-email/{email}", name="app_newsletter_form_confirmation_email")
     * @param string $email
     *
     * @return Response
     */
    public function newsletterConfirmationEmailAction($email)
    {
        $em = $this->getDoctrine()->getManager();
        $contactNewsletter = $em->getRepository('AppBundle:ContactNewsletter')->findOneBy(['email' => $email]);
        $msg = 'KO';

        if ($contactNewsletter) {
            $contactNewsletter->setChecked(true);
            $em->persist($contactNewsletter);
            $em->flush();
            $msg = 'OK';
        }

        return $this->render(
            ':Front/newsletters:confirmation_ok.html.twig',
            [
                'msg' => $msg
            ]
        );
    }
}
