<?php

namespace AppBundle\Tests;

/**
 * Class FrontendControllerTest
 *
 * @category Test
 * @package  AppBundle\Tests
 * @author   David Romaní <david@flux.cat>
 */
class FrontendControllerTest extends AbstractBaseTest
{
    /**
     * Test HTTP request is successful
     *
     * @dataProvider provideUrls
     *
     * @param string $url
     */
    public function testFrontendPagesAreSuccessful($url)
    {
        $client = $this->createClient();           // anonymous user
        $client->request('GET', $url);

        $this->assertStatusCode(200, $client);
    }

    /**
     * Urls provider.
     *
     * @return array
     */
    public function provideUrls()
    {
        return array(
            array('/'),
            array('/projectes/'),
            array('/projecte/my-project/'),
            array('/blog/'),
            array('/blog/categoria/mytag/'),
            array('/blog/2016/11/01/my-post/'),
            array('/sitemap/sitemap.default.xml'),
        );
    }

    /**
     * Test HTTP request is successful
     *
     * @dataProvider provideBrokenUrls
     *
     * @param string $url
     */
    public function testFrontendPagesAreBroken($url)
    {
        $client = $this->createClient();           // anonymous user
        $client->request('GET', $url);

        $this->assertStatusCode(404, $client);
    }

    /**
     * Urls provider.
     *
     * @return array
     */
    public function provideBrokenUrls()
    {
        return array(
            array('/projectes/fake/'),
            array('/broken-page'),
            array('/broken-page/'),
        );
    }
}
