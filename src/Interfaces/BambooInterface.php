<?php

namespace vahidkaargar\BambooCardPortal\Interfaces;

interface BambooInterface
{
    public function catalogs();

    public function account();

    public function orders();

    public function exchange();

    public function transactions();

    public function notifications();
}