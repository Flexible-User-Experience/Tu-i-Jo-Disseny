<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class BlogTag
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BlogTagRepository")
 * @ORM\Table(name="blog_tag")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\Translations\BlogTagTranslation")
 */
class BlogTag extends Base
{
    use Traits\TranslationTrait;

    /**
     * @ORM\ManyToMany(targetEntity="BlogPost", mappedBy="tags", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     * @var ArrayCollection
     */
    protected $posts;

    /**
     * @ORM\OneToMany(
     *   targetEntity="AppBundle\Entity\Translations\BlogTagTranslation",
     *   mappedBy="object",
     *   cascade={"persist", "remove"}
     * )
     * @Assert\Valid(deep = true)
     *
     * @var ArrayCollection
     */
    protected $translations;

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
        $this->posts        = new ArrayCollection();
        $this->translations = new ArrayCollection();
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
