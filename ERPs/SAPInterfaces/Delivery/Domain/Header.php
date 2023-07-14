<?php

namespace ERPs\SAPInterfaces\Delivery\Domain;

use Carbon\Carbon;

class Header
{
    private $number;
    private $date;

    public function __construct(object $header)
    {
        $this->number = (int)trim($header->XBLNR);
        $this->date = $this->formatDate(trim($header->WADAT_IST));
    }

    private function formatDate($string)
    {
        $year = substr($string, -8, 4);
        $month = substr($string, -4, 2);
        $day = substr($string, -2, 2);
        return Carbon::create($year . '-' . $month . '-' . $day);
    }

    public function get()
    {
        return [
            'number' => $this->number,
            'date' => $this->date,
        ];
    }
}
