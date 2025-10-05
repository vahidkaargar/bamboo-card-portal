<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Conditionable;
use vahidkaargar\BambooCardPortal\Bamboo;
use vahidkaargar\BambooCardPortal\Services\CacheService;

class Catalogs extends Bamboo
{
    use Conditionable;

    private int $version = 1;
    private string $currencyCode;
    private string $countryCode;
    private string $name;
    private string $modifiedDate;
    private string $targetCurrency;
    private int $productId;
    private int $pageSize = 100;
    private int $pageIndex = 0;
    private int $brandId;
    private array $payload = [];

    /**
     * @var CacheService|null
     */
    protected ?CacheService $cacheService;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->cacheService = app(CacheService::class);
    }

    /**
     * @return Collection
     * @throws ConnectionException
     */
    public function get(): Collection
    {
        $cacheKey = 'catalog_' . $this->getVersion() . '_' . md5(serialize($this->payload));
        
        return $this->cacheService->remember($cacheKey, function () {
            switch ($this->getVersion()) {
                case 2:
                    $catalog = $this->version2()->http->get('catalog', $this->payload);
                    break;
                case 1:
                default:
                    $catalog = $this->http->get('catalog');
            }
            return $this->collect($catalog);
        });
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
        $this->payload['CurrencyCode'] = $currencyCode;
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
        $this->payload['CountryCode'] = $countryCode;
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
        $this->payload['Name'] = $name;
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
        $this->payload['ModifiedDate'] = $modifiedDate;
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
        $this->payload['TargetCurrency'] = $targetCurrency;
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
        $this->payload['ProductId'] = $productId;
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
    public function setPageSize(int $pageSize = 100): Catalogs
    {
        $this->payload['PageSize'] = $pageSize;
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
    public function setPageIndex(int $pageIndex = 0): Catalogs
    {
        $this->payload['PageIndex'] = $pageIndex;
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
        $this->payload['BrandId'] = $brandId;
        $this->brandId = $brandId;
        return $this;
    }
}