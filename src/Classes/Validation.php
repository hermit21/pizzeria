<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-02-24
 * Time: 11:05
 */

namespace App\Classes;


class Validation
{
    protected $error;

    public function __construct(Errors $error)
    {
        $this->error = $error;
    }

    public function validElements($data)
    {
        $error_message = array();

        foreach ($data as $key => $values)
        {
            switch ($key)
            {
                case 'name':
                    if(($values > 3 ) && ($values < 15))
                    {
                        if(ctype_alpha($values))
                        {
                            $error_message[name] = null;
                            $this->error->putErrors($error_message);

                        }
                        else {
                            $error_message[name] = "The name is not correct";
                            $this->error->putErrors($error_message);
                        }

                    } else {
                        $error_message[name] = "The name must be between 3 and 15 characters";
                        $this->error->putErrors($error_message);
                    }
                break;
                case 'surname':

                 break;
                case 'telephon_number':
                    if($values == 9 && ctype_digit($values))
                    {
                        $error_message[telephon_number] = null;
                        $this->error->putErrors($error_message);
                    }
                    else {
                        $error_message[telephon_number] = "This number is not correct";
                        $this->error->putErrors($error_message);
                    }
                 break;
                case 'address':
                 break;
                case 'email':
                break;
                case 'password':
                    if($values > 4) {
                        $error_message[password] = null;
                        $this->error->putErrors($error_message);
                    }
                    else {
                        $error_message[password] = 'Pasword must have minimum 4 characters';
                        $this->error->putErrors($error_message);
                    }
                break;
                case 'repeat_password':
                    if($values > 4 && $values == $data->password)
                    {
                        $error_message[repeat_password] = null;
                        $this->error->putErrors($error_message);
                    }
                    else {
                        $error_message[repeat_password] = "Password's do not match";
                        $this->error->putErrors($error_message);
                    }
                 break;
                case 'activate_token':
                break;

            }

        }

    }
}