<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Service
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceRepository")
 * @ORM\Table(name="service")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\Translations\ServiceTranslation")
 * @Vich\Uploadable
 */
class Service extends Base
{
    use Traits\TranslationTrait;
    use Traits\ImageTrait;

    /**
     * @ORM\ManyToOne(targetEntity="ServiceCategory", inversedBy="services")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="category_id", referencedColumnName="id")})
     *
     * @var ServiceCategory
     */
    protected $category;

    /**
     * @Vich\UploadableField(mapping="service", fileNameProperty="imageName")
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
     * @ORM\Column(type="text", length=2000, nullable=true)
     * @Gedmo\Translatable
     *
     * @var string
     */
    protected $description;

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="services")
     * @ORM\JoinTable(name="projects_services")
     *
     * @var ArrayCollection
     */
    protected $projects;

    /**
     * @ORM\OneToMany(
     *   targetEntity="AppBundle\Entity\Translations\ServiceTranslation",
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
        $this->projects     = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    /**
     * Set Category
     *
     * @param ServiceCategory $category
     *
     * @return $this
     */
    public function setCategory(ServiceCategory $category)
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
     * Get Projects
     *
     * @return ArrayCollection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Set Projects
     *
     * @param ArrayCollection $projects
     *
     * @return $this
     */
    public function setProjects(ArrayCollection $projects)
    {
        $this->projects = $projects;

        return $this;
    }

    /**
     * @param Project $project
     *
     * @return $this
     */
    public function addProject(Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * @param Project $project
     *
     * @return $this
     */
    public function removeProject(Project $project)
    {
        $this->projects->removeElement($project);

        return $this;
    }
}
