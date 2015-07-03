<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class ServiceCategory
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="removedAt")
 */
class ServiceCategory extends AbstractBase
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;
}
