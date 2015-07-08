<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Project
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 * @ORM\Table(name="project")
 * @Gedmo\SoftDeleteable(fieldName="removedAt")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\Translations\ProjectTranslation")
 * @Vich\Uploadable
 */
class Project extends Base
{
    use Traits\TranslationTrait;
    use Traits\ImageTrait;

    /**
     * @ORM\ManyToMany(targetEntity="Partner", mappedBy="projects")
     *
     * @var ArrayCollection
     */
    protected $partners;

    /**
     * @Vich\UploadableField(mapping="project", fileNameProperty="imageName")
     * @Assert\File(
     *     maxSize = "10M",
     *     mimeTypes = {"image/jpg", "image/jpeg", "image/png", "image/gif"},
     * )
     * @Assert\Image(minWidth = 1200)
     *
     * @var File $imageFile
     */
    protected $imageFile;

    /**
     * @ORM\OneToMany(targetEntity="ProjectImage", mappedBy="project", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     *
     * @var ArrayCollection
     */
    protected $images;

    /**
     * @ORM\ManyToMany(targetEntity="Service", inversedBy="projects")
     * @ORM\JoinTable(name="projects_services")
     *
     * @var ArrayCollection
     */
    protected $services;

    /**
     * @ORM\Column(type="text", length=2000, nullable=true)
     *
     * @var string
     */
    protected $description;

    /**
     * @ORM\OneToMany(
     *   targetEntity="AppBundle\Entity\Translations\ProjectTranslation",
     *   mappedBy="object",
     *   cascade={"persist", "remove"}
     * )
     * @Assert\Valid(deep = true)
     *
     * @var ArrayCollection
     */
    protected $translations;

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
        $this->partners     = new ArrayCollection();
        $this->images       = new ArrayCollection();
        $this->services     = new ArrayCollection();
        $this->translations = new ArrayCollection();
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
