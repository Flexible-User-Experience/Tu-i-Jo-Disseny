<?php

namespace AppBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * Class ServiceRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   David Romaní <david@flux.cat>
 */
class ServiceRepository extends BaseRepository
{
    /**
     * @return QueryBuilder
     */
    public function createBaseQuery()
    {
        return $this->createQueryBuilder('s');
    }

    /**
     * @return QueryBuilder
     */
    public function findAllEnabledSortedByPositionQB()
    {
        $query = $this->createBaseQuery()
            ->where('s.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('s.position');

        return $query;
    }

    /**
     * @return Query
     */
    public function findAllEnabledSortedByPositionQ()
    {
        return $this->findAllEnabledSortedByPositionQB()->getQuery();
    }

    /**
     * @return ArrayCollection
     */
    public function findAllEnabledSortedByPosition()
    {
        return $this->findAllEnabledSortedByPositionQ()->getResult();
    }
}
