<?php

namespace Vadim\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vadim\BlogBundle\Controller\DefaultController;

class DefaultControllerTest extends WebTestCase
{
    public function testAbout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/about/');
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(1, $crawler->filter('h1'));
      }
}
