<?php

namespace AppBundle\Repository;

use AppBundle\Entity\BlogTag;
use Doctrine\ORM\QueryBuilder;

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
     * @return QueryBuilder
     */
    public function commonGetAllEnabledSortedByPublishedDateWithJoinQB()
    {
        return $this->createQueryBuilder('p')
            ->select('p, t')
            ->join('p.tags', 't')
            ->where('p.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.name', 'ASC');
    }

    /**
     * @return array
     */
    public function getAllEnabledSortedByPublishedDateWithJoin()
    {
        return $this->commonGetAllEnabledSortedByPublishedDateWithJoinQB()
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function getAllEnabledSortedByPublishedDateWithJoinUntilNow()
    {
        $now = new \DateTime();

        $query = $this->commonGetAllEnabledSortedByPublishedDateWithJoinQB();
        $query
            ->andWhere('p.publishedAt <= :published')
            ->setParameter('published', $now->format('Y-m-d'));

        return $query->getQuery()->getResult();
    }

    /**
     * @param BlogTag $tag
     *
     * @return array
     */
    public function getAllEnabledSortedByPublishedDateWithJoinUntilNowByTag(BlogTag $tag)
    {
        $now = new \DateTime();

        $query = $this->commonGetAllEnabledSortedByPublishedDateWithJoinQB();
        $query
            ->andWhere('t.id = :tag')
            ->andWhere('p.publishedAt <= :published')
            ->setParameter('tag', $tag->getId())
            ->setParameter('published', $now->format('Y-m-d'));

        return $query->getQuery()->getResult();
    }
}
