<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class ServiceCategory
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceCategoryRepository")
 * @Gedmo\SoftDeleteable(fieldName="removedAt")
 */
class ServiceCategory extends Base
{
    /**
     * @ORM\OneToMany(targetEntity="Service", mappedBy="category", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     *
     * @var ArrayCollection
     */
    protected $services;

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
        $this->services = new ArrayCollection();
    }

    /**
     * Set Services
     *
     * @param ArrayCollection $services
     *
     * @return $this
     */
    public function setServices(ArrayCollection $services)
    {
        $this->services = $services;

        return $this;
    }

    /**
     * Get Services
     *
     * @return ArrayCollection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Add service
     *
     * @param Service $service
     *
     * @return $this
     */
    public function addService(Service $service)
    {
        $service->setCategory($this);
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param Service $service
     *
     * @return $this
     */
    public function removeService(Service $service)
    {
        $this->services->removeElement($service);

        return $this;
    }
}
