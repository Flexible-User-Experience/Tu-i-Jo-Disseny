<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Service
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceRepository")
 * @Gedmo\SoftDeleteable(fieldName="removedAt")
 */
class Service extends ServiceBase
{
    /**
     * @ORM\ManyToOne(targetEntity="ServiceCategory", inversedBy="services")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="category_id", referencedColumnName="id")})
     *
     * @var ServiceCategory
     */
    protected $category;

    /**
     *
     * Methods
     *
     */

    /**
     * Set Category
     *
     * @param ServiceCategory $category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get Category
     *
     * @return ServiceCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}
