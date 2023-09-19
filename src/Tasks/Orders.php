<?php

namespace vahidkaargar\BambooCardPortal\Tasks;


use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

class Orders extends Bamboo
{
    private string $startDate;
    private string $endDate;
    private string $requestId;
    private int $accountId;
    private array $products;

    public function get(int $id = 0): Collection
    {
        if ($id) {
            $orders = $this->http->get("orders/$id");
        } else {
            $orders = $this->http->get('orders', ['startDate' => $this->getStartDate(), 'endDate' => $this->getEndDate()]);
        }

        return $this->collect($orders);
    }

    public function setStartDate(string $date): Orders
    {
        $this->startDate = $date;
        return $this;
    }

    private function getStartDate(): string
    {
        return $this->startDate;
    }

    public function setEndDate(string $date): Orders
    {
        $this->endDate = $date;
        return $this;
    }

    private function getEndDate(): string
    {
        return $this->endDate;
    }


    public function checkout(): Collection
    {
        $checkout = $this->http->post('checkout', [
            'RequestId' => $this->getRequestId(),
            'AccountId' => $this->getAccountId(),
            'Products' => $this->getProducts()
        ]);
        return $this->collect($checkout);
    }

    public function setRequestId(string $value): Orders
    {
        $this->requestId = $value;
        return $this;
    }

    private function getRequestId(): string
    {
        return $this->requestId;
    }


    public function setAccountId(int $value): Orders
    {
        $this->accountId = $value;
        return $this;
    }

    private function getAccountId(): int
    {
        return $this->accountId;
    }


    public function setProduct(int $productId, int $quantity, int $value): Orders
    {
        $this->products[] = [
            "ProductId" => $productId,
            "Quantity" => $quantity,
            "Value" => $value,
        ];
        return $this;
    }

    public function setProducts(array $products): Orders
    {
        $this->products[] = [...$this->getProducts(), ...$products];
        return $this;
    }

    private function getProducts(): array
    {
        return $this->products;
    }
}