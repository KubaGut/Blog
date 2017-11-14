<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 11.11.17
 * Time: 13:37
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Posts;
use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

class PostsTest extends TestCase
{
    public function testSetAndGetDate()
    {
        $post = new Posts();
        $post->setDate('11.11.2017');
        $this->assertEquals('11.11.2017', $post->getDate());
    }

    public function testSetAndGetId()
    {
        $post = new Posts();
        $post->setId(1);
        $this->assertEquals(1, $post->getId());
    }

    public function testSetAndGetTitle()
    {
        $post = new Posts();
        $post->setTitle('post2');
        $this->assertEquals('post2', $post->getTitle());
    }

    public function testGetAndSetText()
    {
        $post = new Posts();
        $post->setText('Oto i tekst posta');
        $this->assertTrue($post->getText() === 'Oto i tekst posta');
    }

    public function testGetAndSetUser()
    {
        $post = new Posts();
        $user = new User();
        $user->setId(2);
        $post->setUser($user);
        $this->assertTrue($post->getUser() == $user);
    }

    public function testGetAndSetBrochure()
    {
        $post = new Posts();
        $post->setBrochure('nazwaPliku');
        $this->assertTrue($post->getBrochure() === 'nazwaPliku');
    }
}