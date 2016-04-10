<?php

namespace AppBundle\Manager;

use AppBundle\Entity\ContactNewsletter;
use AppBundle\Repository\ContactNewsletterRepository;

/**
 * Class ContactNewsletterManager
 *
 * @category Manager
 * @package  AppBundle\Manager
 * @author   David Romaní <david@flux.cat>
 */
class ContactNewsletterManager
{
    /**
     * @var ContactNewsletterRepository
     */
    private $cnr;

    /**
     * ContactNewsletterManager constructor
     *
     * @param ContactNewsletterRepository $cnr
     */
    public function __construct(ContactNewsletterRepository $cnr)
    {
        $this->cnr = $cnr;
    }

    /**
     * @param ContactNewsletter $searchedRecord
     *
     * @return ContactNewsletter
     */
    public function fetchOrCreateNewRecord(ContactNewsletter $searchedRecord)
    {
        $contactNewsletter = $this->cnr->findOneBy(['email' => $searchedRecord->getEmail()]);
        if (!$contactNewsletter) {
            $contactNewsletter = new ContactNewsletter();
            $contactNewsletter->setEmail($searchedRecord->getEmail());
        }
        $contactNewsletter
            ->setChecked(false)
            ->setEnabled(true);

        return $contactNewsletter;
    }
}
