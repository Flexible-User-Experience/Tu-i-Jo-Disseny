<?php

namespace AppBundle\Repository;

use AppBundle\Entity\BlogPost;

/**
 * Class BlogTagRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   David Romaní <david@flux.cat>
 */
class BlogTagRepository extends BaseRepository
{
    /**
     * @param BlogPost $post
     *
     * @return array
     */
    public function getPostTagsSortedByTitle(BlogPost $post)
    {
        $query = $this->createQueryBuilder('t')
            ->where('p.id = :pid')
            ->andWhere('t.enabled = :enabled')
            ->setParameter('pid', $post->getId())
            ->setParameter('enabled', true)
            ->join('t.posts', 'p')
            ->orderBy('t.name');

        return $query->getQuery()->getResult();
    }
}
