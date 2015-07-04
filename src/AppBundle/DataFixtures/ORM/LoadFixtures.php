<?php

namespace AppBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;

/**
 * LoadFixtures class
 *
 * @category Fixtures
 * @package  AppBundle\DataFixtures\ORM
 * @author   David Romaní <david@flux.cat>
 */
class LoadFixtures extends DataFixtureLoader
{
    /**
     * Get fixtures
     *
     * @return array
     */
    public function getFixtures()
    {
        return array(
            __DIR__ . DIRECTORY_SEPARATOR . 'fixtures.' . $this->getEnvironment() . '.yml',
        );
    }

    /**
     * Get Symfony environment
     *
     * @return string
     */
    private function getEnvironment()
    {
        return $this->container->get('kernel')->getEnvironment();
    }
}
