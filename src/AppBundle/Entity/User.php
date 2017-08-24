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
use Symfony\Component\Validator\Constraints as Assert;

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
  * @Assert\NotBlank()
  * @ORM\Column(unique=true,type="string")
  */
 private $username;

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
 private $roles;

 /** @ORM\OneToMany(targetEntity="Posts", mappedBy="user") */
 private $posts;
 /**
  * @var boolean
  * @ORM\column(type="boolean")
  */
 private $active = false;

     /**
      * @return mixed
      */
     public function getActive()
     {
         return $this->active;
     }

     /**
      * @param mixed $active
      */
     public function setActive($active)
     {
         $this->active = $active;
     }


 private $isActive;

     public function __construct()
     {
         $this->isActive = true;
         // may not be needed, see section on salt below
         // $this->salt = md5(uniqid(null, true));
     }

 public function _construct() {
        $this->posts =new ArrayCollection();
    }


     public function getRoles()
     {
         return array($this->roles);
     }


     /**
      * @param mixed $role
      */
     public function setRole($roles)
     {
         $this->roles = $roles;
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
     public function getUsername()
     {
         return $this->username;
     }

     /**
      * @param mixed $username
      */
     public function setUsername($username)
     {
         $this->username = $username;
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



     public function getSalt()
     {
        return null;
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
             $this->username,
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
             $this->username,
             $this->password
            )
             =unserialize($serialized);
     }
 }