<?php

namespace ERPs\SAPInterfaces\Orders\Domain;

use Illuminate\Support\Collection;

class OrderCollection
{
    public $orders;

    public function __construct(object $sapOrders)
    {
        $this->orders = collect();
        $this->buildOrderCollection($sapOrders);
    }

    public function buildOrderCollection(object $sapOrders)
    {
        $classOrders = [];
        if (count((array)$sapOrders->PE_T_PEDIDOS) != 0 && !$sapOrders->PE_ERROR) {
            // if (is_array($sapOrders->PE_T_PEDIDOS->item) && !is_object($sapOrders->PE_T_PEDIDOS->item)) {
            if (is_array($sapOrders->PE_T_PEDIDOS->item)) {
                $classOrders = $sapOrders->PE_T_PEDIDOS->item;
            } else {
                $classOrders[0] = $sapOrders->PE_T_PEDIDOS->item;
            }
            foreach ($classOrders as $order) {
                $this->addOrder(new Order($order));
            }
        }
    }

    private function addOrder($order)
    {
        $this->orders->add($order->get());
    }

    public function get()
    {
        return $this->orders;
    }
}
