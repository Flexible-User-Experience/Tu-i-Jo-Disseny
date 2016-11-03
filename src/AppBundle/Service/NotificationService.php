<?php

namespace AppBundle\Service;

use AppBundle\Entity\ContactMessage;
use AppBundle\Entity\ContactNewsletter;

/**
 * Class NotificationService
 *
 * @category Service
 * @package  AppBundle\Service
 * @author   David Romaní <david@flux.cat>
 */
class NotificationService
{
    /**
     * @var CourierService
     */
    private $messenger;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var string admin mail address
     */
    private $amd;

    /**
     * @var string
     */
    private $urlBase;

    /**
     *
     *
     * Methods
     *
     *
     */

    /**
     * NotificationService constructor
     *
     * @param CourierService    $messenger
     * @param \Twig_Environment $twig
     * @param string            $amd
     * @param string            $urlBase
     */
    public function __construct(CourierService $messenger, \Twig_Environment $twig, $amd, $urlBase)
    {
        $this->messenger = $messenger;
        $this->twig = $twig;
        $this->amd = $amd;
        $this->urlBase = $urlBase;
    }

    /**
     * Send a contact form notification to administrator
     *
     * @param ContactMessage $contactMessage
     */
    public function sendAdminNotification(ContactMessage $contactMessage)
    {
        $this->messenger->sendEmail(
            $contactMessage->getEmail(),
            $this->amd,
            $this->urlBase . ' formulari de contacte rebut',
            $this->twig->render(':Mail:contact_form_admin_notification.html.twig', array(
                'contact' => $contactMessage,
            ))
        );
    }

    /**
     * Send a contact form notification to web user
     *
     * @param ContactMessage $contactMessage
     */
    public function sendUserNotification(ContactMessage $contactMessage)
    {
        $this->messenger->sendEmail(
            $this->amd,
            $contactMessage->getEmail(),
            $this->urlBase . ' pregunta rebuda',
            $this->twig->render(':Mail:contact_form_user_notification.html.twig', array(
                'contact' => $contactMessage,
            ))
        );
    }

    /**
     * Send backend answer notification to web user
     *
     * @param ContactMessage $contactMessage
     */
    public function sendUserBackendNotification(ContactMessage $contactMessage)
    {
        $this->messenger->sendEmail(
            $this->amd,
            $contactMessage->getEmail(),
            $this->urlBase . ' resposta formulari de contacte',
            $this->twig->render(':Mail:contact_form_user_backend_notification.html.twig', array(
                'contact' => $contactMessage,
            ))
        );
    }

    /**
     * Send subscribe to newsletter notification to web user
     *
     * @param ContactNewsletter $contactNewsletter
     */
    public function sendNewsletterUserNotification(ContactNewsletter $contactNewsletter)
    {
        $this->messenger->sendEmail(
            $this->amd,
            $contactNewsletter->getEmail(),
            $this->urlBase . ' registre newsletter',
            $this->twig->render(':Mail:newsletter_form_user_notification.html.twig', array(
                'contact' => $contactNewsletter,
            ))
        );
    }

    /**
     * Send a common notification mail to admin user
     *
     * @param string $text
     */
    public function sendCommonAdminNotification($text)
    {
        $this->messenger->sendEmail(
            $this->amd,
            $this->amd,
            'Notificació pàgina web ' . $this->urlBase,
            $this->twig->render(':Mails:common_admin_notification.html.twig', array(
                'text' => $text,
            ))
        );
    }
}
