<?php

namespace vahidkaargar\BambooCardPortal\Tasks;


use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

/**
 * Orders class
 */
class Orders extends Bamboo
{
    /**
     * @var string
     */
    private string $startDate;
    /**
     * @var string
     */
    private string $endDate;
    /**
     * @var string
     */
    private string $requestId;
    /**
     * @var int
     */
    private int $accountId;
    /**
     * @var array
     */
    private array $products;

    /**
     * @param int $id
     * @return Collection
     */
    public function get(int $id = 0): Collection
    {
        if ($id) {
            $orders = $this->http->get("orders/$id");
        } else {
            $orders = $this->http->get('orders', ['startDate' => $this->getStartDate(), 'endDate' => $this->getEndDate()]);
        }

        return $this->collect($orders);
    }

    /**
     * @param string $date
     * @return $this
     */
    public function setStartDate(string $date): Orders
    {
        $this->startDate = $date;
        return $this;
    }

    /**
     * @return string
     */
    private function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @param string $date
     * @return $this
     */
    public function setEndDate(string $date): Orders
    {
        $this->endDate = $date;
        return $this;
    }

    /**
     * @return string
     */
    private function getEndDate(): string
    {
        return $this->endDate;
    }


    /**
     * @return Collection
     */
    public function checkout(): Collection
    {
        $checkout = $this->http->post('checkout', [
            'RequestId' => $this->getRequestId(),
            'AccountId' => $this->getAccountId(),
            'Products' => $this->getProducts()
        ]);
        return $this->collect($checkout);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setRequestId(string $value): Orders
    {
        $this->requestId = $value;
        return $this;
    }

    /**
     * @return string
     */
    private function getRequestId(): string
    {
        return $this->requestId;
    }


    /**
     * @param int $value
     * @return $this
     */
    public function setAccountId(int $value): Orders
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * @return int
     */
    private function getAccountId(): int
    {
        return $this->accountId;
    }


    /**
     * @param int $productId
     * @param int $quantity
     * @param int $value
     * @return $this
     */
    public function setProduct(int $productId, int $quantity, int $value): Orders
    {
        $this->products[] = [
            "ProductId" => $productId,
            "Quantity" => $quantity,
            "Value" => $value,
        ];
        return $this;
    }

    /**
     * @param array $products
     * @return $this
     */
    public function setProducts(array $products): Orders
    {
        $this->products = [...$this->getProducts(), ...$products];
        return $this;
    }

    /**
     * @return array
     */
    private function getProducts(): array
    {
        return $this->products;
    }
}