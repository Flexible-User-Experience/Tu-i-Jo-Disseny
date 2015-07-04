<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class FrontendControllerTest
 *
 * @category Test
 * @package  AppBundle\Tests\Controller
 * @author   David Romaní <david@flux.cat>
 */
class FrontendControllerTest extends WebTestCase
{
    /**
     * Test HTTP request is successful
     *
     * @dataProvider provideUrls
     * @param string $url
     */
    public function testFrontendPagesAreSuccessful($url)
    {
        $client = $this->createClient();
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
            array('/app/example'),
        );
    }
}
