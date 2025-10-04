<?php

namespace vahidkaargar\BambooCardPortal\Tests\Unit\Tasks;

use Illuminate\Support\Str;
use vahidkaargar\BambooCardPortal\Tests\TestCase;
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
        parent::setUp();
        $this->bamboo = new Bamboo('test_user', 'test_pass', true);
        $this->product = ["ProductId" => 1, "Quantity" => 5, "Value" => 100];
        $this->products = [
            ["ProductId" => 42, "Quantity" => 10, "Value" => 50],
            ["ProductId" => 71, "Quantity" => 15, "Value" => 10],
            ["ProductId" => 23, "Quantity" => 50, "Value" => 5],
        ];
    }

    public function testIsSetAccountIdWorks()
    {
        $requestIdShouldBe = Str::uuid();
        $getRequestId = $this->bamboo->orders()
            ->setRequestId($requestIdShouldBe)
            ->getRequestId();
        $this->assertEquals($getRequestId, $requestIdShouldBe);
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

    public function testIsSetStartDateWorks()
    {
        $dateShouldBe = '2022-10-09';
        $getStartDate = $this->bamboo->orders()
            ->setStartDate($dateShouldBe)
            ->getStartDate();
        $this->assertEquals($dateShouldBe, $getStartDate);
    }

    public function testIsSetEndDateWorks()
    {
        $dateShouldBe = '2022-10-09';
        $getEndDate = $this->bamboo->orders()
            ->setEndDate($dateShouldBe)
            ->getEndDate();
        $this->assertEquals($dateShouldBe, $getEndDate);
    }
}