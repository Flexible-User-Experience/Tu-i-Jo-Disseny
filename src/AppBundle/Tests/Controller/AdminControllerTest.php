<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AdminControllerTest
 *
 * @category Test
 * @package  AppBundle\Tests\Controller
 * @author   David Romaní <david@flux.cat>
 */
class AdminControllerTest extends WebTestCase
{
    /**
     * Test HTTP request is successful
     *
     * @dataProvider provideUrls
     * @param string $url
     */
    public function testAdminPagesAreSuccessful($url)
    {
        $client = $this->createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ));
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * Urls provider.
     *
     * @return array
     */
    public function provideUrls()
    {
        return array(
            array('/admin/dashboard'),
        );
    }
}
