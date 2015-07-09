<?php

namespace AppBundle\Manager;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Swift_Mailer;

/**
 * Class MailManager
 *
 * @category Manager
 * @package  AppBundle\Manager
 * @author   David Romaní <david@flux.cat>
 */
class MailManager
{
    /**
     * @var TwigEngine
     */
    private $ts;

    /**
     * @var Swift_Mailer $sm
     */
    private $sms;

    /**
     * Constructor
     *
     * @param TwigEngine   $templating
     * @param Swift_Mailer $mailer
     */
    public function __construct(TwigEngine $templating, Swift_Mailer $mailer)
    {
        $this->ts = $templating;
        $this->sms = $mailer;
    }

    /**
     * Perform Test Email Command Delivery action
     */
    public function doTestEmailCommandDelivery()
    {
        $this->delivery('Tu&Jo Disseny webapp email test', 'info@flux.cat', 'Flux', 'Message body test');
    }

    /**
     * Deliver email notifitacion task
     *
     * @param string $subject
     * @param string $address
     * @param string $name
     * @param string $message
     */
    private function delivery($subject, $address, $name, $message)
    {
        /** @var \Swift_Message $emailMessage */
        $emailMessage = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('estudi@tujodisseny.com')
            ->setTo($address, $name)
            ->setBody(
                $this->ts->render(
                    'Mail/test.html.twig',
                    array(
                        'subject' => $subject,
                        'address' => $address,
                        'name'    => $name,
                        'message' => $message,
                    )
                )
            )
            ->setCharset('UTF-8')
            ->setContentType('text/html');

        $this->sms->send($emailMessage);
    }
}
