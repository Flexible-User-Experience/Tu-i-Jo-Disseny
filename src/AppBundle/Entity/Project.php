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
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\Translations\ProjectTranslation")
 * @Vich\Uploadable
 */
class Project extends Base
{
    use Traits\TranslationTrait;
    use Traits\ImageTrait;

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
     * @ORM\Column(type="text", length=2000, nullable=true)
     * @Gedmo\Translatable
     *
     * @var string
     */
    protected $description;

    /**
     * @ORM\Column(type="boolean", options={"default" = false})
     *
     * @var boolean
     */
    protected $showInHomepage = false;

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
        $this->images       = new ArrayCollection();
        $this->translations = new ArrayCollection();
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

    /**
     * Get ShowInHomepage
     *
     * @return boolean
     */
    public function getShowInHomepage()
    {
        return $this->showInHomepage;
    }

    /**
     * Set ShowInHomepage
     *
     * @param boolean $showInHomepage
     *
     * @return $this
     */
    public function setShowInHomepage($showInHomepage)
    {
        $this->showInHomepage = $showInHomepage;

        return $this;
    }
}
