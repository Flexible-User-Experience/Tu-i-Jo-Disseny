<?php

namespace AppBundle\Tests;

/**
 * Class AdminControllerTest
 *
 * @category Test
 * @package  AppBundle\Tests
 * @author   David Romaní <david@flux.cat>
 */
class AdminControllerTest extends AbstractBaseTest
{
    /**
     * Test admin login request is successful
     */
    public function testAdminLoginPageIsSuccessful()
    {
        $client = $this->createClient();           // anonymous user
        $client->request('GET', '/admin/login');

        $this->assertStatusCode(200, $client);
    }

    /**
     * Test HTTP request is successful
     *
     * @dataProvider provideSuccessfulUrls
     * @param string $url
     */
    public function testAdminPagesAreSuccessful($url)
    {
        $client = $this->makeClient(true);         // authenticated user
        $client->request('GET', $url);

        $this->assertStatusCode(200, $client);
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
            array('/admin/web/servei/list'),
            array('/admin/web/servei/create'),
            array('/admin/web/servei/1/edit'),
            array('/admin/web/servei/1/delete'),
            array('/admin/web/projecte/list'),
            array('/admin/web/projecte/create'),
            array('/admin/web/projecte/1/edit'),
            array('/admin/web/projecte/1/delete'),
            array('/admin/web/imatge-projecte/list'),
            array('/admin/web/imatge-projecte/create'),
            array('/admin/web/imatge-projecte/1/edit'),
            array('/admin/web/imatge-projecte/1/delete'),
            array('/admin/web/equip/list'),
            array('/admin/web/equip/create'),
            array('/admin/web/equip/1/edit'),
            array('/admin/web/equip/1/delete'),
            array('/admin/blog/etiqueta/list'),
            array('/admin/blog/etiqueta/create'),
            array('/admin/blog/etiqueta/1/edit'),
            array('/admin/blog/etiqueta/1/delete'),
            array('/admin/blog/article/list'),
            array('/admin/blog/article/create'),
            array('/admin/blog/article/1/edit'),
            array('/admin/blog/article/1/delete'),
            array('/admin/contactes/missatge/list'),
            array('/admin/contactes/missatge/1/show'),
            array('/admin/contactes/missatge/1/answer'),
            array('/admin/contactes/missatge/1/delete'),
            array('/admin/contactes/newsletter/list'),
            array('/admin/contactes/newsletter/create'),
            array('/admin/contactes/newsletter/1/edit'),
            array('/admin/contactes/newsletter/1/delete'),
            array('/admin/usuari/list'),
            array('/admin/usuari/create'),
            array('/admin/usuari/1/edit'),
            array('/admin/usuari/1/delete'),
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
        $client = $this->makeClient(true);         // authenticated user
        $client->request('GET', $url);

        $this->assertStatusCode(404, $client);
    }

    /**
     * Successful Urls provider
     *
     * @return array
     */
    public function provideNotFoundUrls()
    {
        return array(
            array('/admin/web/servei/1/show'),
            array('/admin/web/servei/batch'),
            array('/admin/web/projecte/1/show'),
            array('/admin/web/projecte/batch'),
            array('/admin/web/imatge-projecte/1/show'),
            array('/admin/web/imatge-projecte/batch'),
            array('/admin/web/equip/1/show'),
            array('/admin/web/equip/batch'),
            array('/admin/blog/etiqueta/1/show'),
            array('/admin/blog/etiqueta/batch'),
            array('/admin/blog/article/1/show'),
            array('/admin/blog/article/batch'),
            array('/admin/contactes/missatge/create'),
            array('/admin/contactes/missatge/1/edit'),
            array('/admin/contactes/missatge/batch'),
            array('/admin/contactes/newsletter/1/show'),
            array('/admin/contactes/newsletter/batch'),
        );
    }
}
