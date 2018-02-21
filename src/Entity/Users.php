<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $telephon_number;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $activate_token;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password_token;

    /**
     * @ORM\Column(type="integer")
     */
    private $privilage_user;

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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getTelephonNumber()
    {
        return $this->telephon_number;
    }

    /**
     * @param mixed $telephon_number
     */
    public function setTelephonNumber($telephon_number): void
    {
        $this->telephon_number = $telephon_number;
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
    public function setUsername($username): void
    {
        $this->username = $username;
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
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt): void
    {
        $this->salt = $salt;
    }

    /**
     * @return mixed
     */
    public function getActivateToken()
    {
        return $this->activate_token;
    }

    /**
     * @param mixed $activate_token
     */
    public function setActivateToken($activate_token): void
    {
        $this->activate_token = $activate_token;
    }

    /**
     * @return mixed
     */
    public function getPasswordToken()
    {
        return $this->password_token;
    }

    /**
     * @param mixed $password_token
     */
    public function setPasswordToken($password_token): void
    {
        $this->password_token = $password_token;
    }

    /**
     * @return mixed
     */
    public function getPrivilageUser()
    {
        return $this->privilage_user;
    }

    /**
     * @param mixed $privilage_user
     */
    public function setPrivilageUser($privilage_user): void
    {
        $this->privilage_user = $privilage_user;
    }



}
