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
     * @Method({"GET"})
     * @param Request $request
     *
     * @return Response
     */
    public function homepageAction(Request $request)
    {
        $projects = $this->getDoctrine()->getRepository('AppBundle:Project')->findAllEnabledAndShowInHomepageSortedByPosition();
        $services = $this->getDoctrine()->getRepository('AppBundle:Service')->findAllEnabledSortedByPosition();
        $contact = new ContactMessage();
        $form = $this->createForm(ContactMessageType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }


        return $this->render(
            '::Front/homepage.html.twig',
            [
                'projects'     => $projects,
                'services'     => $services,
                'contact_form' => $form->createView(),
            ]
        );
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
