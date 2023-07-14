<?php

namespace ERPs\SAPInterfaces\Stock\Domain;

class Header
{
    private $productCode;
    private $description;
    private $storage;
    private $meUnit; // measurement unit
    private $productCategory;

    public function __construct(object $header)
    {
            $this->productCode = (int)trim($header->MATNR);
            $this->description = trim($header->MAKTX);
            $this->storage = trim($header->DEPOSITO);
            $this->meUnit = trim($header->MEINS);
            $this->productCategory = trim($header->MATKL);
    }

    public function get()
    {
        return [
            'productCode' =>$this->productCode,
            'description' =>$this->description,
            'storage' =>$this->storage,
            'meUnit' =>$this->meUnit,
            'productCategory' =>$this->productCategory,
        ];
    }
}
