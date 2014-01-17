<?php

namespace Vadim\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vadim\BlogBundle\Controller\DefaultController;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/about/');
       // $file = fopen("../about_files/about.html", "r");
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
       // $this->assertTrue(file_get_contents("about.html"),$crawler);
        //$this->assertRegExp(file_get_contents($file), $response->getContent());
    }
}
