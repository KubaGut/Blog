<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 18.11.17
 * Time: 08:26
 */

namespace Tests\AppBundle\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Entity\User;


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

        $link = $crawler->filter('a:contains("Log In")')->link();
        $this->assertEquals('http://localhost/login', $client->click($link)->getUri());
    }

    public function testHomeActionStatusCode()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/home');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testHomePageContent()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/home');
        $this->assertGreaterThan(0, $crawler->filter('div:contains("Go")')->count() );
    }

    public function testLoginActionStatusCode()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Log In')->form();
        $form['_username'] = 'login1';
        $form['_password'] = 'haslo1';
        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertEquals(0, $crawler->filter('.error')->count());
        $this->assertEquals('http://localhost/user', $crawler->getUri());
    }

    public function testRegisterActionStatusCode()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testRegisterAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('appbundle_user[Save]')->form();
        $form['appbundle_user[userName]'] = 'Mariola3';
        $form['appbundle_user[phoneNumber]'] = '123-234-234';
        $form['appbundle_user[password]'] = 'Kazia';
        $form['appbundle_user[email]'] = 'jakub_gutkowski@wp.pl';
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertEquals('http://localhost/index', $crawler->getUri());
    }

    public function testRegisterActionInvalidEmail()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('appbundle_user[Save]')->form();
        $form['appbundle_user[userName]'] = "Zdzisiu3";
        $form['appbundle_user[phoneNumber]'] = '123-234-234';
        $form['appbundle_user[password]'] = 'Kazia';
        $form['appbundle_user[email]'] = 'jakub_gutkowskiwp.pl';
        $client->submit($form);
        $this->assertEquals('http://localhost/register', $crawler->getUri());
        //$this->assertEquals(1, $crawler->filter('.error')->count());
    }

    public function testConfirmationAction()
    {
        $user = new User();
        $user->setUsername('Marek');

        $userRepository = $this->createMock(ObjectRepository::class);
        $userRepository->expects($this->any())->method('findOneById(1)')->willReturn($user);

        $em = $this->createMock(ObjectManager::class);
        $em->expects($this->any())->method('getRepository')->willReturn($userRepository);

        $client = static::createClient();
        $crawler = $client->request('GET', '/confirmation/1');
        $crawler = $client->followRedirect();

        $this->assertEquals('http://localhost/index2', $crawler->getUri());
        $this->assertEquals($user->isActive(), true);
    }




}