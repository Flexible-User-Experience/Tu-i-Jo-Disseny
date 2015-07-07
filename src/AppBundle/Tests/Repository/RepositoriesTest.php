<?php

namespace AppBundle\Tests\Repository;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class RepositoriesTest
 *
 * @category Test
 * @package  AppBundle\Tests\Repository
 * @author   David Romaní <david@flux.cat>
 */
class RepositoriesTest extends WebTestCase
{
    /**
     * Test repository methods
     */
    public function testRepository()
    {
        $this->loadFixtures(array('AppBundle\DataFixtures\ORM\LoadFixtures'));
        $em = $this->getContainer()->get('doctrine')->getManager();
        $this->assertEquals(5, $em->getRepository('AppBundle:ServiceCategory')->getInstancesAmount());
        $this->assertEquals(10, $em->getRepository('AppBundle:Service')->getInstancesAmount());
        $this->assertEquals(20, $em->getRepository('AppBundle:Project')->getInstancesAmount());
        $this->assertEquals(5, $em->getRepository('AppBundle:Partner')->getInstancesAmount());
        $this->assertEquals(5, $em->getRepository('AppBundle:BlogTag')->getInstancesAmount());
        $this->assertEquals(10, $em->getRepository('AppBundle:BlogPost')->getInstancesAmount());
    }
}
