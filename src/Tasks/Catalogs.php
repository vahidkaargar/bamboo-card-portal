<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

class Catalogs extends Bamboo
{
    private int $version = 1;
    private string $currencyCode;
    private string $countryCode;
    private string $name;
    private string $modifiedDate;
    private string $targetCurrency;
    private int $productId;
    private int $pageSize;
    private int $pageIndex;
    private int $brandId;

    /**
     * @return Collection
     */
    public function get(): Collection
    {
        switch ($this->getVersion()) {
            case 2:
                $catalog = $this->version2()->http->get('catalog');
                break;
            case 1:
            default:
                $catalog = $this->http->get('catalog');
        }
        return $this->collect($catalog);
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @param int $version
     * @return Catalogs
     */
    public function setVersion(int $version): Catalogs
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     * @return Catalogs
     */
    public function setCurrencyCode(string $currencyCode): Catalogs
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     * @return Catalogs
     */
    public function setCountryCode(string $countryCode): Catalogs
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Catalogs
     */
    public function setName(string $name): Catalogs
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getModifiedDate(): string
    {
        return $this->modifiedDate;
    }

    /**
     * @param string $modifiedDate
     * @return Catalogs
     */
    public function setModifiedDate(string $modifiedDate): Catalogs
    {
        $this->modifiedDate = $modifiedDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getTargetCurrency(): string
    {
        return $this->targetCurrency;
    }

    /**
     * @param string $targetCurrency
     * @return Catalogs
     */
    public function setTargetCurrency(string $targetCurrency): Catalogs
    {
        $this->targetCurrency = $targetCurrency;
        return $this;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return Catalogs
     */
    public function setProductId(int $productId): Catalogs
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     * @return Catalogs
     */
    public function setPageSize(int $pageSize): Catalogs
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageIndex(): int
    {
        return $this->pageIndex;
    }

    /**
     * @param int $pageIndex
     * @return Catalogs
     */
    public function setPageIndex(int $pageIndex): Catalogs
    {
        $this->pageIndex = $pageIndex;
        return $this;
    }

    /**
     * @return int
     */
    public function getBrandId(): int
    {
        return $this->brandId;
    }

    /**
     * @param int $brandId
     * @return Catalogs
     */
    public function setBrandId(int $brandId): Catalogs
    {
        $this->brandId = $brandId;
        return $this;
    }
}