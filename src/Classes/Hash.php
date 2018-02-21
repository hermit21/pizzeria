<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-02-18
 * Time: 21:59
 */

namespace App\Classes;


class Hash
{
    /**
     * @param $obj_parameters
     * @return \stdClass
     */
    public function sanetizeParameters($obj_parameters)
    {
        $result = new \stdClass();
        foreach ($obj_parameters as $key => $parameter)
        {
            $result->$key = htmlspecialchars(trim($parameter), ENT_QUOTES, 'utf-8' );
        }
        return $result;
    }

    /**
     * @param $size
     * @return string
     */
    public function generateToken($size)
    {
        $characters = 'qwertyuiop[]{}1234567890QWERTYUIOPASDF!@#$%^&*()asdfghjkl:_-+=|zxcvbnm<>,.?~GHJKLZXCVBNM';
        $token = '';

        for($i = 0; $i < $size; $i++) {
            $rand = rand(0, strlen($characters) - 1);
            $token.= substr($characters, $rand, 1);
        }

        return $token;

    }

    /**
     * @param $token
     * @return string
     */
    public function hashToken($token)
    {
        return hash('sha256', $token);
    }

    /**
     * @param $password
     * @param $salt
     * @return string
     */
    public function makeHash($password, $salt)
    {
        return hash('sha512', $password.$salt);
    }

    public function compareValues($password, $salt, $hash_passowd)
    {
        if(self::makeHash($password, $salt) == $hash_passowd) {
            return true;
        }
        else {
            return false;
        }
    }


}