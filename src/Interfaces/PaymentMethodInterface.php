<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-02-24
 * Time: 11:21
 */

namespace App\Interfaces;



interface PaymentMethodInterface
{
    public function processPeyment();
}