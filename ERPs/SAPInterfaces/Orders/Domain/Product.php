<?php

namespace ERPs\SAPInterfaces\Orders\Domain;

class Product
{
    private $position;                  // POSNR	"000030"
    private $productCode;           // MATNR	"000000009000000006" --> Código del material
    private $description;      // MAKTX	"Tarima 1.15x1.18mts (Bloques)"
    private $meUnQuantity;    // UM_CANTIDAD	"UN" --> unidad de medida de cantidad
    private $quantity;                  // CANTIDAD	"          18"
    private $meUnWeight;        // UM_PESO	"KG" --> unidad de medida de peso
    private $weight;                      // PESO	"           0"
    private $palletConvert;         // CONV_PALLET	"0"
    private $productCategory;         // MATKL	"0" --> Categoría del producto?? CONFIRMAR
    private $abgru; // ABGRU --> NO ESPECIFICADO

    public function __construct(object $product)
    {
        if ($this->validateProduct($product)) {
            $this->setPosition(trim($product->POSNR));
            $this->setProductCode(trim($product->MATNR));
            $this->setDescription(trim($product->MAKTX));
            $this->setMeUnQuantity(trim($product->UM_CANTIDAD));
            $this->setQuantity(trim($product->CANTIDAD));
            $this->setMeUnWeight(trim($product->UM_PESO));
            $this->setWeight(trim($product->PESO));
            $this->setPalletConvert(trim($product->CONV_PALLET));
            $this->setProductCategory(trim($product->MATKL));
        }
    }

    private function setPosition($position)
    {
        $this->position = $position;
    }

    private function setProductCode($productCode)
    {
        $this->productCode = $productCode;
    }

    private function setDescription($description)
    {
        $this->description = $description;
    }

    private function setMeUnQuantity($meUnQuantity)
    {
        $this->meUnQuantity = $meUnQuantity;
    }

    private function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    private function setMeUnWeight($meUnWeight)
    {
        $this->meUnWeight = $meUnWeight;
    }

    private function setWeight($weight)
    {
        $this->weight = $weight;
    }

    private function setPalletConvert($palletConvert)
    {
        $this->palletConvert = $palletConvert;
    }

    private function setProductCategory($productCategory)
    {
        $this->productCategory = $productCategory;
    }

    private function validateProduct(object $product): bool
    {
        if (isset($product->POSNR)) {
            return true;
        }
        return false;
    }

    public function get()
    {
        return [
            'position' => (int)$this->position,
            'productCode' => (int)$this->productCode,
            'description' => (string)$this->description,
            'meUnQuantity' => (string)$this->meUnQuantity,
            'quantity' => floatval($this->quantity),
            'meUnWeight' => (string)$this->meUnWeight,
            'weight' => floatval($this->weight),
            'palletConvert' => floatval($this->palletConvert),
            'productCategory' => (string)$this->productCategory,
            'abgru' => (string)$this->abgru,
        ];
    }
}
