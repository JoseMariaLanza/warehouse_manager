<?php

namespace ERPs\SAPInterfaces\Delivery\Domain;


class DeliveryCollection
{
    public $deliveries;
    public $error;

    public function __construct(object $sapDeliveries)
    {
        $this->deliveries = collect();
        $this->error = $sapDeliveries->PE_ERROR;
        $this->buildDeliveryCollection($sapDeliveries);
    }

    public function buildDeliveryCollection(object $sapDeliveries)
    {
        $classDeliveries = [];
        if (count((array)$sapDeliveries->PE_T_REMITOS) != 0 && !$sapDeliveries->PE_ERROR) {
            // if (is_array($sapDeliveries->PE_T_REMITOS->item) && !is_object($sapDeliveries->PE_T_REMITOS->item)) {
            if (is_array($sapDeliveries->PE_T_REMITOS->item)) {
                $classDeliveries = $sapDeliveries->PE_T_REMITOS->item;
            } else {
                $classDeliveries[0] = $sapDeliveries->PE_T_REMITOS->item;
            }
            foreach ($classDeliveries as $delivery) {
                $this->addDelivery((new Delivery($delivery))->get());
            }
        }
    }

    private function addDelivery($delivery)
    {
        $this->deliveries->add($delivery);
    }

    public function get()
    {
        return $this->deliveries;
    }
}
