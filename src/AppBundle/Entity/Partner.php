<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Partner
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartnerRepository")
 * @ORM\Table(name="partner")
 * @Gedmo\SoftDeleteable(fieldName="removedAt")
 * @Vich\Uploadable
 */
class Partner extends Base
{
    use Traits\ImageTrait;

    /**
     * @ORM\ManyToMany(targetEntity="Project", inversedBy="partners")
     * @ORM\JoinTable(name="partners_projects")
     *
     * @var ArrayCollection
     */
    protected $projects;

    /**
     * @ORM\Column(type="text", length=2000, nullable=true)
     *
     * @var string
     */
    protected $description;

    /**
     * @Vich\UploadableField(mapping="partner", fileNameProperty="imageName")
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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     *
     * @var string
     */
    protected $web;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(
     *  checkHost = true,
     *  checkMX = true,
     *  strict = true
     * )
     *
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    protected $twitter;

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
        $this->projects = new ArrayCollection();
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
     * Get Projects
     *
     * @return ArrayCollection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Add project
     *
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
     * Remove project
     *
     * @param Project $project
     *
     * @return $this
     */
    public function removeProject(Project $project)
    {
        $this->projects->removeElement($project);

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
     * Set Web
     *
     * @param string $web
     *
     * @return $this
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get Web
     *
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set Email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set Twitter
     *
     * @param string $twitter
     *
     * @return $this
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get Twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }
}
