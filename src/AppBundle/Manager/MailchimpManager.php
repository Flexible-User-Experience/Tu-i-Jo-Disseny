<?php

namespace AppBundle\Manager;

use AppBundle\Entity\ContactMessage;
use AppBundle\Service\NotificationService;
use MZ\MailChimpBundle\Services\MailChimp;

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
     * @param MailChimp           $mailChimp
     * @param NotificationService $messenger
     */
    public function __construct(MailChimp $mailChimp, NotificationService $messenger)
    {
        $this->mailChimp = $mailChimp;
        $this->messenger = $messenger;
    }

    /**
     * Mailchimp Manager
     *
     * @param string $email
     * @param string $listId
     *
     * @return boolean       $result
     */
    public function subscribeContactToList($email, $listId)
    {
        $this->mailChimp->setListID($listId);
        $list = $this->mailChimp->getList();
        $list->setDoubleOptin(false);
        $result = $list->Subscribe($email);
        // Check contact to list
        if ($result == false) {
            $this->messenger->sendCommonAdminNotification('En ' . $email . ' no s\'ha pogut registrar a la llista Newsletter de Mailchimp per algun motiu desconegut');
        }

        return $result;
    }
}
