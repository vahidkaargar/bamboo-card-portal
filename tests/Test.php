<?php

namespace vahidkaargar\BambooCardPortal\Tests;

use Illuminate\Support\Str;
use vahidkaargar\BambooCardPortal\Bamboo;

class Test
{
    public function index()
    {
        $bamboo = new Bamboo();


        $orders = $bamboo->orders()
            ->setStartDate('2022-05-02')
            ->setEndDate('2022-05-20')
            ->get();
    }
}