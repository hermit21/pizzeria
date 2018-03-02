<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-02-24
 * Time: 14:11
 */

namespace App\Classes;


class Checking extends Hash
{
    /**
     * @param String $pass
     * @param String $salt
     * @param String $hash_pass
     * @return bool
     */
    public function checkValues( String $pass, String $salt, String $hash_pass)
    {

       if($hash_pass == $this->makeHash($pass, $salt)) {
           return true;
       }
       else {
           return false;
       }
    }

}