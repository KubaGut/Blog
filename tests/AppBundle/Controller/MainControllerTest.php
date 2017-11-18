<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 18.11.17
 * Time: 08:26
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class MainControllerTest extends WebTestCase
{
    public function testIndexActionStatusCode()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/index');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testIndexActionLinks()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/index');

        $link = $crawler->filter('a:contains("Home")')->link();
        $this->assertEquals('http://localhost/home', $client->click($link)->getUri());

        $link = $crawler->filter('a:contains("Log Out")')->link();
        $this->assertEquals('http://localhost/logout', $client->click($link)->getUri());

        $link = $crawler->filter('a:contains("Register")')->link();
        $this->assertEquals('http://localhost/register', $client->click($link)->getUri());
    }
}