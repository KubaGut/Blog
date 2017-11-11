<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 11.11.17
 * Time: 08:25
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase
{

    public function testGetAndSetId()
    {
        $user = new User();
        $user->setId(1);
        $this->assertEquals(1, $user->getId());

    }

    public function testGetAndGetUsername()
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






}
