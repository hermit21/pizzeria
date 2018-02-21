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

class Instances
{
    public function setRegisterData($register_obj)
    {
        $user = new Users();
        $user->setName($register_obj->name);
        $user->setSurname($register_obj->surname);
        $user->setAddress($register_obj->address);
        $user->setTelephonNumber($register_obj->telephon_number);
        $user->setUsername($register_obj->username);
        $user->setPassword($register_obj->password);
        $user->setSalt($register_obj->salt);
        $user->setActivateToken($register_obj->activate_token);
        $user->setPasswordToken($register_obj->password_token);
        $user->setPrivilageUser(1);

        return $user;
    }

    public function setOrder($order_obj)
    {
        $order = new Orders();

        $order->setName($order_obj->pizza_name);
        $order->getUserId($order_obj->user_id);
        $order->setDescriptions($order_obj->description);
        $order->setDateTimeRequest(date(Y-m-d));
        $order->setSize($order_obj->pizza_size);
        $order->setTotalPrice($order_obj->total_price);

        return $order;
    }
}