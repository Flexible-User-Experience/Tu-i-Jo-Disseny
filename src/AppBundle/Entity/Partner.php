<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Partner.
 *
 * @category Entity
 *
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartnerRepository")
 * @ORM\Table(name="partner")
 * @Vich\Uploadable
 */
class Partner extends Base
{
    use Traits\ImageTrait;

    /**
     * @ORM\Column(type="text", length=2000, nullable=true)
     * @Gedmo\Translatable
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
     * @var File
     */
    protected $imageFile;

    /**
     * @Vich\UploadableField(mapping="partner", fileNameProperty="imageName2")
     * @Assert\File(
     *     maxSize = "10M",
     *     mimeTypes = {"image/jpg", "image/jpeg", "image/png", "image/gif"},
     * )
     * @Assert\Image(minWidth = 1200)
     *
     * @var File
     */
    protected $imageFile2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    protected $imageName2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    protected $studies;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(checkDNS=true)
     *
     * @var string
     */
    protected $web;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(checkHost = true, checkMX = true, strict = true)
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
     * Methods.
     */

    /**
     * Set ImageFile2.
     *
     * @param File $imageFile
     *
     * @return $this
     */
    public function setImageFile2(File $imageFile = null)
    {
        $this->imageFile2 = $imageFile;
        if ($imageFile) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * Get ImageFile2.
     *
     * @return File
     */
    public function getImageFile2()
    {
        return $this->imageFile2;
    }

    /**
     * Set ImageName2.
     *
     * @param string $imageName
     *
     * @return $this
     */
    public function setImageName2($imageName)
    {
        $this->imageName2 = $imageName;

        return $this;
    }

    /**
     * Get ImageName2.
     *
     * @return string
     */
    public function getImageName2()
    {
        return $this->imageName2;
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
     * Get Studies.
     *
     * @return string
     */
    public function getStudies()
    {
        return $this->studies;
    }

    /**
     * Set Studies.
     *
     * @param string $studies
     *
     * @return $this
     */
    public function setStudies($studies)
    {
        $this->studies = $studies;

        return $this;
    }

    /**
     * Set Web.
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
     * Get Web.
     *
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set Email.
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
     * Get Email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set Twitter.
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
     * Get Twitter.
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }
}
