<?php

namespace vahidkaargar\BambooCardPortal\Tests\Unit\Tasks;

use Orchestra\Testbench\TestCase;
use vahidkaargar\BambooCardPortal\Bamboo;

/**
 *
 */
class OrdersTest extends TestCase
{

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->bamboo = new Bamboo();
        $this->product = ["ProductId" => 1, "Quantity" => 5, "Value" => 100];
        $this->products = [
            ["ProductId" => 42, "Quantity" => 10, "Value" => 50],
            ["ProductId" => 71, "Quantity" => 15, "Value" => 10],
            ["ProductId" => 23, "Quantity" => 50, "Value" => 5],
        ];
    }

    /**
     * @return void
     */
    public function testIsSetProductsWorks()
    {
        $getProductsShouldBe = [...$this->products, $this->product];

        $getProducts = $this->bamboo->orders()
            ->setProducts($this->products)
            ->setProduct(...array_values($this->product))
            ->getProducts();
        $this->assertEquals($getProducts, $getProductsShouldBe);
    }
}