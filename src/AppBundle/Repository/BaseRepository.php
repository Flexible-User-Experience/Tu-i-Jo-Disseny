<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class BaseRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   David Romaní <david@flux.cat>
 */
abstract class BaseRepository extends EntityRepository
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
