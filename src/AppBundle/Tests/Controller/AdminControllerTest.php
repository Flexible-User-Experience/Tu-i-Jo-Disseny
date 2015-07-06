<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

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
     * @dataProvider provideSuccessfulUrls
     * @param string $url
     */
    public function testAdminPagesAreSuccessful($url)
    {
        $client = $this->getAuthenticadedUser();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * Successful Urls provider
     *
     * @return array
     */
    public function provideSuccessfulUrls()
    {
        return array(
            array('/admin/dashboard'),
            array('/admin/services/category/list'),
            array('/admin/services/category/create'),
            array('/admin/services/category/1/edit'),
            array('/admin/services/service/list'),
            array('/admin/services/service/create'),
            array('/admin/services/service/1/edit'),
            array('/admin/projects/project/list'),
            array('/admin/projects/project/create'),
            array('/admin/projects/project/1/edit'),
            array('/admin/projects/image/list'),
            array('/admin/projects/image/create'),
            array('/admin/projects/image/1/edit'),
            array('/admin/partners/partner/list'),
            array('/admin/partners/partner/create'),
            array('/admin/partners/partner/1/edit'),
            array('/admin/blog/tag/list'),
            array('/admin/blog/tag/create'),
            array('/admin/blog/tag/1/edit'),
            array('/admin/blog/post/list'),
            array('/admin/blog/post/create'),
            array('/admin/blog/post/1/edit'),
        );
    }

    /**
     * Test HTTP request is not found
     *
     * @dataProvider provideNotFoundUrls
     * @param string $url
     */
    public function testAdminPagesAreNotFound($url)
    {
        $client = $this->getAuthenticadedUser();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isNotFound());
    }

    /**
     * Successful Urls provider
     *
     * @return array
     */
    public function provideNotFoundUrls()
    {
        return array(
            array('/admin/services/category/1/delete'),
            array('/admin/services/service/1/delete'),
            array('/admin/projects/project/1/delete'),
            array('/admin/projects/image/1/delete'),
            array('/admin/partners/partner/1/delete'),
            array('/admin/blog/post/1/delete'),
            array('/admin/blog/post/1/delete'),
        );
    }

    /**
     * Get authenticated user
     *
     * @return Client
     */
    private function getAuthenticadedUser()
    {
        return $this->createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ));
    }
}
