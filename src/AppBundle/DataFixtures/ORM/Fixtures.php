<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 25.11.17
 * Time: 09:52
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
            $user = new User();
            $user->setUsername('Fixture1');
            $user->setPassword('1234');
            $user->setEmail('jakub_gutkowski@wp.pl');
            $user->setRole("ROLE_USER");
            $user->setPhoneNumber("123-123-123");
            //$encoded = $encoder->encodePassword($user, $user->getPassword());
            //$user->setPassword($encoded);
            $user->setIsActive(false);

            $manager->persist($user);
            $manager->flush();
    }
}
