<?php

namespace AppBundle\Tests;

use AppBundle\Entity\Base;

/**
 * Class RepositoriesTest
 *
 * @category Test
 * @package  AppBundle\Tests
 * @author   David Romaní <david@flux.cat>
 */
class RepositoriesTest extends AbstractBaseTest
{
    /**
     * Test repository bulk methods
     */
    public function testRepositories()
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $this->assertEquals( 3, $em->getRepository('AppBundle:ServiceCategory')->getInstancesAmount());
        $this->assertEquals( 5, $em->getRepository('AppBundle:Service')->getInstancesAmount());
        $this->assertEquals(10, $em->getRepository('AppBundle:Project')->getInstancesAmount());
        $this->assertEquals(20, $em->getRepository('AppBundle:ProjectImage')->getInstancesAmount());
        $this->assertEquals( 2, $em->getRepository('AppBundle:Partner')->getInstancesAmount());
        $this->assertEquals( 2, $em->getRepository('AppBundle:BlogTag')->getInstancesAmount());
        $this->assertEquals(10, $em->getRepository('AppBundle:BlogPost')->getInstancesAmount());
        $this->assertEquals( 0, $em->getRepository('AppBundle:Group')->getInstancesAmount());
        $this->assertEquals( 2, $em->getRepository('AppBundle:User')->getInstancesAmount());
    }

    /**
     * Test enabled items amount
     */
    public function testFindAllEnabledRepositories()
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $items = $em->getRepository('AppBundle:ServiceCategory')->findAll();
        $this->assertEquals($this->getEnabledItemsAmount($items), $em->getRepository('AppBundle:ServiceCategory')->findAllEnabledSortedByNameAmount());

        $items = $em->getRepository('AppBundle:Service')->findAll();
        $this->assertEquals($this->getEnabledItemsAmount($items), $em->getRepository('AppBundle:Service')->findAllEnabledSortedByNameAmount());

        $items = $em->getRepository('AppBundle:Project')->findAll();
        $this->assertEquals($this->getEnabledItemsAmount($items), $em->getRepository('AppBundle:Project')->findAllEnabledSortedByNameAmount());

        $items = $em->getRepository('AppBundle:Partner')->findAll();
        $this->assertEquals($this->getEnabledItemsAmount($items), $em->getRepository('AppBundle:Partner')->findAllEnabledSortedByNameAmount());

        $items = $em->getRepository('AppBundle:BlogTag')->findAll();
        $this->assertEquals($this->getEnabledItemsAmount($items), $em->getRepository('AppBundle:BlogTag')->findAllEnabledSortedByNameAmount());

        $items = $em->getRepository('AppBundle:BlogPost')->findAll();
        $this->assertEquals($this->getEnabledItemsAmount($items), $em->getRepository('AppBundle:BlogPost')->findAllEnabledSortedByNameAmount());
    }

    /**
     * @param array $items
     *
     * @return int
     */
    private function getEnabledItemsAmount(array $items)
    {
        $enabled = 0;
        /** @var Base $item */
        foreach ($items as $item) {
            if ($item->getEnabled()) {
                $enabled++;
            }
        }

        return $enabled;
    }
}
