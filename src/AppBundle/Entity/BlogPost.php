<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class BlogPost
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BlogPostRepository")
 * @Gedmo\SoftDeleteable(fieldName="removedAt")
 */
class BlogPost extends Base
{
    /**
     * @ORM\ManyToMany(targetEntity="BlogTag", inversedBy="posts")
     * @ORM\JoinTable(name="posts_tags")
     *
     * @var ArrayCollection
     */
    protected $tags;

    /**
     * @ORM\Column(type="text", length=4000, nullable=true)
     *
     * @var string
     */
    protected $description;

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
     * Set Tags
     *
     * @param ArrayCollection $tags
     *
     * @return $this
     */
    public function setTags(ArrayCollection $tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get Tags
     *
     * @return ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add tag
     *
     * @param BlogTag $tag
     *
     * @return $this
     */
    public function addTag(BlogTag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param BlogTag $tag
     *
     * @return $this
     */
    public function removeTag(BlogTag $tag)
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * Set Description
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
