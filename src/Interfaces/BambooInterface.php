<?php

namespace vahidkaargar\BambooCardPortal\Interfaces;

/**
 * Bamboo interface
 */
interface BambooInterface
{
    /**
     * @return mixed
     */
    public function catalogs();

    /**
     * @return mixed
     */
    public function accounts();

    /**
     * @return mixed
     */
    public function orders();

    /**
     * @return mixed
     */
    public function exchange();

    /**
     * @return mixed
     */
    public function transactions();

    /**
     * @return mixed
     */
    public function notifications();
}