<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Project
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 * @Gedmo\SoftDeleteable(fieldName="removedAt")
 */
class Project extends Base
{
    /**
     * @ORM\ManyToMany(targetEntity="Partner", mappedBy="projects")
     *
     * @var ArrayCollection
     */
    protected $partners;

    /**
     * @ORM\OneToMany(targetEntity="ProjectImage", mappedBy="project", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     *
     * @var ArrayCollection
     */
    protected $images;

    /**
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="projects")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="service_id", referencedColumnName="id")})
     *
     * @var Service
     */
    protected $service;

    /**
     * @var string
     *
     * @ORM\Column(type="text", length=2000, nullable=true)
     */
    protected $description;

    /**
     *
     * Methods
     *
     */

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->partners = new ArrayCollection();
        $this->images   = new ArrayCollection();
    }

    /**
     * Set Partners
     *
     * @param ArrayCollection $partners
     *
     * @return $this
     */
    public function setPartners(ArrayCollection $partners)
    {
        $this->partners = $partners;

        return $this;
    }

    /**
     * Get Partners
     *
     * @return ArrayCollection
     */
    public function getPartners()
    {
        return $this->partners;
    }

    /**
     * Add partner
     *
     * @param Partner $partner
     *
     * @return $this
     */
    public function addPartner(Partner $partner)
    {
        $this->partners[] = $partner;

        return $this;
    }

    /**
     * Remove partner
     *
     * @param Partner $partner
     *
     * @return $this
     */
    public function removePartner(Partner $partner)
    {
        $this->partners->removeElement($partner);

        return $this;
    }

    /**
     * Set Images
     *
     * @param ArrayCollection $images
     *
     * @return $this
     */
    public function setImages(ArrayCollection $images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get Images
     *
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add image
     *
     * @param ProjectImage $image
     *
     * @return $this
     */
    public function addImage(ProjectImage $image)
    {
        $image->setProject($this);
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param ProjectImage $image
     *
     * @return $this
     */
    public function removeImage(ProjectImage $image)
    {
        $this->images->removeElement($image);

        return $this;
    }

    /**
     * Set Service
     *
     * @param Service $service
     *
     * @return $this
     */
    public function setService(Service $service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get Service
     *
     * @return Service
     */
    public function getService()
    {
        return $this->service;
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
