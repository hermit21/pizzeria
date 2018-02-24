<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-02-18
 * Time: 21:59
 */

namespace App\Classes;

use App\Classes\Tokens;

class Hash
{

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
        return hash('sha512', $password.self::hashToken($salt));
    }


}