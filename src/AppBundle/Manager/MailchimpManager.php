<?php

namespace AppBundle\Manager;

use AppBundle\Service\NotificationService;
use \DrewM\MailChimp\MailChimp;

/**
 * Class MailchimpManager
 *
 * @category Manager
 * @package  AppBundle\Manager
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class MailchimpManager
{
    /**
     * @var MailChimp $mailChimp
     */
     private $mailChimp;

    /**
     * @var NotificationService
     */
    private $messenger;

    /**
     *
     *
     * Methods
     *
     *
     */

    /**
     * MailchimpManager constructor.
     *
     * @param NotificationService $messenger
     * @param string              $mailchimpApiKey
     */
    public function __construct(NotificationService $messenger, $mailchimpApiKey)
    {
        $this->mailChimp = new MailChimp($mailchimpApiKey);
        $this->messenger = $messenger;
    }

    /**
     * Mailchimp Manager
     *
     * @param string $email
     * @param string $listId
     *
     * @return boolean $result
     */
    public function subscribeContactToList($email, $listId)
    {
        // make HTTP API request
        $result = $this->mailChimp->post('lists/' . $listId . '/members', array(
            'email_address' => $email,
            'status'        => 'subscribed',
        ));

        // check error
        if ($result === false) {
            $this->messenger->sendCommonAdminNotification('El mail ' . $email . ' no s\'ha pogut registrar a la llista de Mailchimp');
        }

        return $result;
    }
}
