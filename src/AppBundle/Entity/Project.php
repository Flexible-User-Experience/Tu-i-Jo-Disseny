<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Project.
 *
 * @category Entity
 *
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 * @ORM\Table(name="project")
 * @Vich\Uploadable
 */
class Project extends Base
{
    use Traits\ImageTrait;

    /**
     * @Vich\UploadableField(mapping="project", fileNameProperty="imageName")
     * @Assert\File(
     *     maxSize = "10M",
     *     mimeTypes = {"image/jpg", "image/jpeg", "image/png", "image/gif"},
     * )
     * @Assert\Image(minWidth = 1200)
     *
     * @var File
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
     * @Gedmo\Translatable
     *
     * @var string
     */
    protected $description;

    /**
     * @ORM\Column(type="boolean", options={"default" = false})
     *
     * @var bool
     */
    protected $showInHomepage = false;

    /**
     * Methods.
     */

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->services = new ArrayCollection();
    }

    /**
     * Set Images.
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
     * Get Images.
     *
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add image.
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
     * Remove image.
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
     * Set Services.
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
     * Get Services.
     *
     * @return ArrayCollection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Add service.
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
     * Remove service.
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
     * Set Description.
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
     * Get Description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get ShowInHomepage.
     *
     * @return bool
     */
    public function getShowInHomepage()
    {
        return $this->showInHomepage;
    }

    /**
     * Set ShowInHomepage.
     *
     * @param bool $showInHomepage
     *
     * @return $this
     */
    public function setShowInHomepage($showInHomepage)
    {
        $this->showInHomepage = $showInHomepage;

        return $this;
    }
}
