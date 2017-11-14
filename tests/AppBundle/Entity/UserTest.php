<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 11.11.17
 * Time: 08:25
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\User;
use AppBundle\Entity\Posts;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase
{
    public function testConstructor()
    {
        $user = new User();
        $this->assertEquals(false, $user->isActive());
    }

    public function testSetIsActive()
    {
        $user = new User();
        $user->setIsActive(true);
        $this->assertEquals(true, $user->isActive());
    }

    public function testSetRole()
    {
        $user = new User();
        $user->setRole('User');
        $this->assertEquals('User', $user->getRoles()[0]);
    }

    public function testGetAndSetId()
    {
        $user = new User();
        $user->setId(1);
        $this->assertEquals(1, $user->getId());
    }

    public function testGetAndSetUsername()
    {
        $user = new User();
        $user->setUsername('Jakub');
        $this->assertTrue($user->getUsername() === 'Jakub');
    }

    public function testGetAndSetPassword()
    {
        $user = new User();
        $user->setPassword('123');
        $this->assertEquals($user->getPassword(), '123');
    }

    public function testGetAndSetPhoneNumber()
    {
        $user = new User();
        $user->setPhoneNumber('123-345-321');
        $this->assertEquals($user->getPhoneNumber(), '123-345-321');
    }

    public function testGetAndSetEmail()
    {
        $user = new User();
        $user->setEmail('jakub@hotmail.com');
        $this->assertEquals($user->getEmail(), 'jakub@hotmail.com');
    }

    public function testGetAndSetPosts()
    {
        $user = new User();
        $posts = new Posts();
        $posts->setId(1);
        $posts->setTitle('post1');

        $user->setPosts($posts);
        $this->assertEquals($user->getPosts(), $posts);
    }

    public function testGetSalt()
    {
        $user = new User();
        $this->assertTrue($user->getSalt() === null);
    }
}
