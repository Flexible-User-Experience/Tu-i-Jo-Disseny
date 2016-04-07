<?php

namespace AppBundle\Entity\Traits;

use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ImageTrait
 *
 * @category Trait
 * @package  AppBundle\Entity\Traits
 * @author   David Romaní <david@flux.cat>
 */
trait ImageTrait
{
    /**
     * @ORM\Column(name="image_name", type="string", length=255, nullable=true)
     *
     * @var string $imageName
     */
    protected $imageName;

    /**
     * Set ImageFile
     *
     * @param File $imageFile
     *
     * @return $this
     */
    public function setImageFile(File $imageFile = null)
    {
        $this->imageFile = $imageFile;
        if ($imageFile) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * Get ImageFile
     *
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set ImageName
     *
     * @param string $imageName
     *
     * @return $this
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get ImageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }
}
