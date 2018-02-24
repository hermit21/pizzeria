<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-02-19
 * Time: 13:35
 */

namespace App\Classes;


use App\Entity\Orders;
use App\Entity\Users;

class InstancesRegistration
{

    protected $user;

    public function __construct(Users $user)
    {
        $this->user = $user;
    }

    public function setRegisterData($register_obj)
    {

        $this->user->setName($register_obj->name);
        $this->user->setSurname($register_obj->surname);
        $this->user->setAddress($register_obj->address);
        $this->user->setTelephonNumber($register_obj->telephon_number);
        $this->user->setUsername($register_obj->username);
        $this->user->setPassword($register_obj->password);
        $this->user->setSalt($register_obj->salt);
        $this->user->setActivateToken($register_obj->activate_token);
        $this->user->setPasswordToken($register_obj->password_token);
        $this->user->setPrivilageUser(1);

        return $this->user;
    }

}