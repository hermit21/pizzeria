<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-02-24
 * Time: 14:11
 */

namespace App\Classes;


class Checking
{
    public function __construct()
    {

    }

    /**
     * @param String $exist_value
     * @param String $expected_value
     * @return bool
     */
    public function checkValues( String $exist_value, String $expected_value) :string
    {
        if($exist_value == $expected_value)
        {
            return false;
        }
        else {
            return false;
        }
    }

}