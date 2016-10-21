<?php

namespace AppBundle\Repository;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * Class ProjectRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   David Romaní <david@flux.cat>
 */
class ProjectRepository extends BaseRepository
{
    /**
     * @return QueryBuilder
     */
    public function createBaseQuery()
    {
        return $this->createQueryBuilder('p');
    }

    /**
     * @return QueryBuilder
     */
    public function findAllEnabledAndShowInHomepageSortedByPositionQB()
    {
        $query = $this->createBaseQuery()
            ->where('p.enabled = :enabled')
            ->andWhere('p.showInHomepage = :sid')
            ->setParameter('enabled', true)
            ->setParameter('sid', true)
            ->orderBy('p.position');

        return $query;
    }

    /**
     * @return Query
     */
    public function findAllEnabledAndShowInHomepageSortedByPositionQ()
    {
        return $this->findAllEnabledAndShowInHomepageSortedByPositionQB()->getQuery();
    }

    /**
     * @return array
     */
    public function findAllEnabledAndShowInHomepageSortedByPosition()
    {
        return $this->findAllEnabledAndShowInHomepageSortedByPositionQ()->getResult();
    }

    /**
     * @return QueryBuilder
     */
    public function findAllEnabledSortedByPositionQB()
    {
        $query = $this->createBaseQuery()
            ->where('p.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('p.position');

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
     * @return array
     */
    public function findAllEnabledSortedByPosition()
    {
        return $this->findAllEnabledSortedByPositionQ()->getResult();
    }
}
