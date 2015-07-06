<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class BlogTag
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BlogTagRepository")
 * @ORM\Table(name="blog_tag")
 * @Gedmo\SoftDeleteable(fieldName="removedAt")
 */
class BlogTag extends Base
{
    /**
     * @ORM\ManyToMany(targetEntity="BlogPost", mappedBy="tags")
     *
     * @var ArrayCollection
     */
    protected $posts;

    /*
     *
     * Methods
     *
     */

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * Set Posts
     *
     * @param ArrayCollection $posts
     *
     * @return $this
     */
    public function setPosts(ArrayCollection $posts)
    {
        $this->posts = $posts;

        return $this;
    }

    /**
     * Get Posts
     *
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add post
     *
     * @param BlogPost $post
     *
     * @return $this
     */
    public function addPost(BlogPost $post)
    {
        $post->setTag($this);
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param BlogPost $post
     *
     * @return $this
     */
    public function removePost(BlogPost $post)
    {
        $this->posts->removeElement($post);

        return $this;
    }
}
