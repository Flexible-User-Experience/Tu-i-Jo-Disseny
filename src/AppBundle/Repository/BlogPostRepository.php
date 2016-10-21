<?php

namespace AppBundle\Repository;

/**
 * Class BlogPostRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   David Romaní <david@flux.cat>
 */
class BlogPostRepository extends BaseRepository
{
    /**
     * @return array
     */
    public function getAllEnabledSortedByPublishedDateWithJoin()
    {
        $query = $this->createQueryBuilder('p')
            ->select('p, t')
            ->join('p.tags', 't')
            ->where('p.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.name', 'ASC')
            ->getQuery();

        return $query->getResult();
    }
}
