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
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name ? $this->name : '---';
    }
}
