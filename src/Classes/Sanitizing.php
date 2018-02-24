<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-02-24
 * Time: 11:08
 */

namespace App\Classes;


class Sanitizing extends Validation
{
    /**
     * @param $obj_data
     * @return \stdClass
     */
    public function sanitizingParameters($obj_data)
    {
        $result = new \stdClass();

        foreach ($obj_data as $key => $parameter)
        {
            $result->$key = htmlspecialchars(trim($parameter), ENT_QUOTES, 'utf-8' );
        }
        return $result;
    }
}