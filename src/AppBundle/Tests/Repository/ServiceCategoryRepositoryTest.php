<?php

namespace AppBundle\Tests\Repository;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ServiceCategoryRepositoryTest
 *
 * @category Test
 * @package  AppBundle\Tests\Repository
 * @author   David Romaní <david@flux.cat>
 */
class ServiceCategoryRepositoryTest extends WebTestCase
{
    /** @var EntityManager */
    private $em;

    public function setUp()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $this->em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    /**
     * Test repository methods
     */
    public function testRepository()
    {
        $this->assertEquals(5, $this->em->getRepository('AppBundle:ServiceCategory')->getInstancesAmount());
    }
}
