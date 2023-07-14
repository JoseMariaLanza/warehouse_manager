<?php

namespace ERPs\SAPInterfaces\Orders\Domain;

use App\Adaptadores\Productos\Producto;

class Order
{
    private $header;
    private $bills;
    private $products;

    public function __construct(object $order)
    {
        $this->setHeader($order->CABECERA);

        $this->buildBills($order);

        $this->buildProducts($order);
    }

    private function buildBills($order)
    {
        $this->bills = collect();
        if (isset($order->FACTURAS->item) && !is_object($order->FACTURAS->item)) {
            $bills = $order->FACTURAS->item;
        } else {
            $bills[0] = $order->FACTURAS;
        }
        foreach ($bills as $bill) {
            $this->addBill($bill);
        }
    }

    public function buildProducts($order)
    {
        $this->products = collect();
        if (isset($order->POSICIONES->item) && !is_object($order->POSICIONES->item)) {
            $products = $order->POSICIONES->item;
        } else {
            $products[0] = $order->POSICIONES->item;
        }
        foreach ($products as $product) {
            // $this->addProduct($product);
            // Si se desea implementar la clase Products:
            // 1 - Modificar la clase Products (Podés guiarte de
            // las clases Customer, Order y OrderCollection para parsear los datos
            // dentro de las mismas clases)
            // 2 - Eliminar la línea anterior, descomentar la siguiente
            $this->addProduct((new Product($product))->get());

            // IMPORTANTE: El beneficio de implementar la clase Product
            // es que en la misma clase se pueden setear los tipos de datos
            // ya casteados al front, lo que hace evita errores de tipos de datos
            // Además se pueden hacer operaciones aritméticas en con los números por ejemplo
            // Es decir, puede hacerse la lógica de negocio en el backend,
            // lo cual es lo correcto.
            // Finalmente podés enviar los datos listos para ser consimidos en el front
            // lo que reduce la lógica en el mismo
        }
    }

    private function setHeader($header)
    {
        $this->header = $header;
    }

    private function addBill($bill)
    {
        $this->bills->add($bill);
    }

    private function addProduct($product)
    {
        $this->products->add($product);
    }

    public function get()
    {
        return [
            'header' => $this->header,
            'bills' => $this->bills,
            'products' => $this->products,
        ];
    }
}
