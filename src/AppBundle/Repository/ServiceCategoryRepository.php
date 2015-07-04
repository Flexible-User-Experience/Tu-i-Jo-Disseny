<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ServiceCategoryRepository extends EntityRepository
{
    /**
     * Get total amount of instances persisted
     *
     * @return int
     */
    public function getInstancesAmount()
    {
        return count($this->findAll());
    }
}
