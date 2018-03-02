<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-03-02
 * Time: 10:08
 */

namespace App\Classes;


use App\Entity\PizzaList;

class InstancePizza
{
    private $pizzaList;

    public function __construct(PizzaList $pizzaList)
    {
        $this->pizzaList = $pizzaList;
    }

    public function setPizza($data_form)
    {
        $this->pizzaList->setName($data_form->name);
        $this->pizzaList->setSize($data_form->size);
        $this->pizzaList->setIngredients($data_form->ingredients);
        $this->pizzaList->setDescriptions($data_form->description);
        $this->pizzaList->setPrice($data_form->price);

        return $this->pizzaList;
    }
}