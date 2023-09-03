<?php

namespace vahidkaargar\BambooCardPortal;

abstract class AbstractBamboo
{
    abstract public function catalogs();

    abstract public function account();

    abstract public function orders();

    abstract public function exchange();

    abstract public function transactions();

    abstract public function notification();
}