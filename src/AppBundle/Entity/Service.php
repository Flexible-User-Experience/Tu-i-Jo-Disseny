<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Service
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceRepository")
 * @Gedmo\SoftDeleteable(fieldName="removedAt")
 */
class Service extends ServiceBase
{
}
