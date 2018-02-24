<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-02-24
 * Time: 14:08
 */

namespace App\Classes;


class Tokens extends Hash
{

    /**
     * @param $lenght
     * @return string
     */
    public function generateToken($size) :string
    {
        $characters = 'qwertyuiop[]{}1234567890QWERTYUIOPASDF!@#$%^&*()asdfghjkl:_-+=|zxcvbnm<>,.?~GHJKLZXCVBNM';
        $token = '';

        for($i = 0; $i < $size; $i++) {
            $rand = rand(0, strlen($characters) - 1);
            $token.= substr($characters, $rand, 1);
        }

        return $token;
    }
}