<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 12.08.17
 * Time: 15:08
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="Users")
 */
 class User implements UserInterface, \Serializable {

 /** @ORM\Column(type="integer")
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="AUTO")
 */
 private $id;

 /**
  * @ORM\Column(type="string")
  */
 private $userName;

 /**
  * @ORM\Column(type="string")
  */
 private $phoneNumber;

 /**
  * @ORM\Column(type="string")
  */
 private $password;

 /**
  * @ORM\Column(type="string")
  */
 private $email;

 /**
  * @ORM\Column(type="string")
  */
 private $role;

 /** @ORM\OneToMany(targetEntity="Posts", mappedBy="user") */
 private $posts;

    public function _construct() {
        $this->posts =new ArrayCollection();
    }

     /**
      * @return mixed
      */
     public function getRole()
     {
         return $this->role;
     }

     /**
      * @param mixed $role
      */
     public function setRole($role)
     {
         $this->role = $role;
     }
     /**
      * @return mixed
      */
     public function getId()
     {
         return $this->id;
     }

     /**
      * @param mixed $id
      */
     public function setId($id)
     {
         $this->id = $id;
     }

     /**
      * @return mixed
      */
     public function getUserName()
     {
         return $this->userName;
     }

     /**
      * @param mixed $userName
      */
     public function setUserName($userName)
     {
         $this->userName = $userName;
     }

     /**
      * @return mixed
      */
     public function getPhoneNumber()
     {
         return $this->phoneNumber;
     }

     /**
      * @param mixed $phoneNumber
      */
     public function setPhoneNumber($phoneNumber)
     {
         $this->phoneNumber = $phoneNumber;
     }

     /**
      * @return mixed
      */
     public function getPassword()
     {
         return $this->password;
     }

     /**
      * @param mixed $password
      */
     public function setPassword($password)
     {
         $this->password = $password;
     }

     /**
      * @return mixed
      */
     public function getEmail()
     {
         return $this->email;
     }

     /**
      * @param mixed $email
      */
     public function setEmail($email)
     {
         $this->email = $email;
     }

     /**
      * @return mixed
      */
     public function getPosts()
     {
         return $this->posts;
     }

     /**
      * @param mixed $posts
      */
     public function setPosts($posts)
     {
         $this->posts = $posts;
     }

     public function getRoles()
     {
         // TODO: Implement getRoles() method.
     }

     public function getSalt()
     {
         // TODO: Implement getSalt() method.
     }


     public function eraseCredentials()
     {
         // TODO: Implement eraseCredentials() method.
     }

     /**
      * String representation of object
      * @link http://php.net/manual/en/serializable.serialize.php
      * @return string the string representation of the object or null
      * @since 5.1.0
      */
     public function serialize()
     {
         return serialize(array(
             $this->id,
             $this->userName,
             $this->password
         ));
     }

     /**
      * Constructs the object
      * @link http://php.net/manual/en/serializable.unserialize.php
      * @param string $serialized <p>
      * The string representation of the object.
      * </p>
      * @return void
      * @since 5.1.0
      */
     public function unserialize($serialized)
     {
         list(
             $this->id,
             $this->userName,
             $this->password
            )
             =unserialize($serialized);
     }
 }