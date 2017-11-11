<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 11.11.17
 * Time: 12:55
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

class UserDoctrineTest extends TestCase
{
    public function testPasswordCoding()
    {
        $user = new User();
        $user->setUsername('Jakub');
        $user->setPassword('1234');

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

    }
}