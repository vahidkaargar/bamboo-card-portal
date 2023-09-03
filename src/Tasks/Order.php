<?php

namespace vahidkaargar\BambooCardPortal\Tasks;


use Illuminate\Support\Collection;

class Order extends Task
{
    private string $startDate;
    private string $endDate;
    private string $requestId;
    private int $accountId;
    private array $products;

    public function get(int $id = 0): Collection
    {
        if ($id) {
            $request = $this->http->get("orders/$id");
        } else {
            $request = $this->http->get('orders', ['startDate' => $this->getStartDate(), 'endDate' => $this->getEndDate()]);
        }
        return $this->api->collect($request);
    }

    public function setStartDate(string $date): Order
    {
        $this->startDate = $date;
        return $this;
    }

    private function getStartDate(): string
    {
        return $this->startDate;
    }

    public function setEndDate(string $date): Order
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
        $request = $this->http->post('checkout', [
            'RequestId' => $this->getRequestId(),
            'AccountId' => $this->getAccountId(),
            'Products' => $this->getProducts()
        ]);
        return $this->api->collect($request);
    }

    public function setRequestId(string $value): Order
    {
        $this->requestId = $value;
        return $this;
    }

    private function getRequestId(): string
    {
        return $this->requestId;
    }


    public function setAccountId(int $value): Order
    {
        $this->accountId = $value;
        return $this;
    }

    private function getAccountId(): int
    {
        return $this->accountId;
    }


    public function setProducts(int $productId, int $quantity, int $value): Order
    {
        $this->products[] = [
            "ProductId" => $productId,
            "Quantity" => $quantity,
            "Value" => $value,
        ];
        return $this;
    }

    private function getProducts(): array
    {
        return $this->products;
    }
}