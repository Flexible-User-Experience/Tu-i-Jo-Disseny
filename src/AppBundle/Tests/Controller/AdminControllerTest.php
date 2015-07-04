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
            array('/admin/services/category/list'),
            array('/admin/services/category/create'),
            array('/admin/services/category/1/edit'),
            array('/admin/services/category/1/delete'),
            array('/admin/services/service/list'),
            array('/admin/services/service/create'),
            array('/admin/services/service/1/edit'),
            array('/admin/services/service/1/delete'),
            array('/admin/projects/project/list'),
            array('/admin/projects/project/create'),
            array('/admin/projects/project/1/edit'),
            array('/admin/projects/project/1/delete'),
        );
    }
}
