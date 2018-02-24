<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-02-24
 * Time: 11:23
 */

namespace App\Classes;


class Errors
{
    public $error = array();

    public function putErrors(array $messeges) :void
    {
        $this->error = $messeges;
    }

    public function displayError()
    {
        return $this->error;
    }
}