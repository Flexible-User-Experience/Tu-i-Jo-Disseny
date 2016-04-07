<?php

namespace AppBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @return ArrayCollection
     */
    public function findAllEnabledAndShowInHomepageSortedByDate()
    {
        return $this->findAllEnabledAndShowInHomepageSortedByPositionQ()->getResult();
    }
}
