<?php
/**
 * Created by PhpStorm.
 * User: Hermit
 * Date: 2018-02-24
 * Time: 10:53
 */

namespace App\Classes;


use App\Entity\Orders;

class InstanceOrder
{
    protected $order;

    public function __construct(Orders $order)
    {
        $this->order = $order;
    }

    /**
     * @param $order_obj
     * @return Orders
     */
    public function setOrders($order_obj)
    {
        $this->order->setName($order_obj->pizza_name);
        $this->order->getUserId($order_obj->user_id);
        $this->order->setDescriptions($order_obj->description);
        $this->order->setDateTimeRequest(date(Y-m-d));
        $this->order->setSize($order_obj->pizza_size);
        $this->order->setTotalPrice($order_obj->total_price);

        return $this->order;
    }


}