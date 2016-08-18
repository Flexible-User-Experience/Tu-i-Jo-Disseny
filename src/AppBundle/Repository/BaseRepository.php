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
        return count($this->createQueryBuilder('p')->getQuery()->getResult());
    }

    /**
     * Find only enabled entities sorted by name
     *
     * @return array
     */
    public function findAllEnabledSortedByName()
    {
        return $this->findBy(
            array(
                'enabled' => true,
            ),
            array(
                'name' => 'asc',
            )
        );
    }

    /**
     * Find only enabled entities sorted by name amount
     *
     * @return int
     */
    public function findAllEnabledSortedByNameAmount()
    {
        return count($this->findAllEnabledSortedByName());
    }
}
