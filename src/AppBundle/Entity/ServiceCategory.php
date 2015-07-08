<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ServiceCategory
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceCategoryRepository")
 * @ORM\Table(name="service_category")
 * @Gedmo\SoftDeleteable(fieldName="removedAt")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\Translations\ServiceCategoryTranslation")
 */
class ServiceCategory extends Base
{
    use Traits\TranslationTrait;

    /**
     * @ORM\OneToMany(targetEntity="Service", mappedBy="category", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     *
     * @var ArrayCollection
     */
    protected $services;

    /**
     * @ORM\OneToMany(
     *   targetEntity="AppBundle\Entity\Translations\ServiceCategoryTranslation",
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
        $this->services     = new ArrayCollection();
        $this->translations = new ArrayCollection();
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
