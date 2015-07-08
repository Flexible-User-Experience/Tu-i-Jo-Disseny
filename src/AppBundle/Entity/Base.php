<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Base
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 */
abstract class Base extends AbstractBase
{
    /**
     * @ORM\Column(type="string", length=255)
     * @Gedmo\Translatable
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Gedmo\Slug(fields={"name"})
     *
     * @var string
     */
    protected $slug;

    /**
     *
     * Methods
     *
     */

    /**
     * Set Name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Slug
     *
     * @param string $slug
     *
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get Slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name ? $this->name : '---';
    }
}
