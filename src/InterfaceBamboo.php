<?php

namespace vahidkaargar\BambooCardPortal;

interface InterfaceBamboo
{
    public function catalogs();

    public function account();

    public function orders();

    public function exchange();

    public function transactions();

    public function notification();
}