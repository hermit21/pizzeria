<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-02-24
 * Time: 17:03
 */

namespace App\Tests\ClassesTest;

use App\Classes\Errors;
use App\Classes\Sanitizing;
use App\Classes\Validation;

use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{

    protected $sanitize;
    protected $errors;

    public function test__construct(Errors $errors, Sanitizing $sanitizing)
    {
        $this->assertAttributeEmpty($this->errors, $errors);
        $this->assertAttributeEmpty($this->sanitize, $sanitizing);
    }

    public function testValidElements()
    {
        $validation = new Validation();

        $data_register = new \stdClass();

        $data_register->name = 'Janusz';
        $data_register->telephon_number = '989786756';
        $data_register->password = 'Start12';
        $data_register->repeat_password = 'Start12';

        $this->assertEquals($validation->validElements($data_register),'ok');

    }

    public function testIsValid()
    {
        $error =  new Errors();
        $error->putErrors(array(name=>'Name is incorrect'));

        $this->assertArrayHasKey(name, $error->displayError());

    }
}
