<?php

namespace AppBundle\Entity;

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
     * Set Service
     *
     * @param Service $service
     *
     * @return $this
     */
    public function setService($service)
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
