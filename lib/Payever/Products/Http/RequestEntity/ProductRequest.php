<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  RequestEntity
 * @package   Payever\Products
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Products\Http\RequestEntity;

use Payever\Sdk\Core\Http\MessageEntity\RequestEntity;
use Payever\Sdk\Products\Http\MessageEntity\ProductCategoryEntity;
use Payever\Sdk\Products\Http\MessageEntity\ProductShippingEntity;
use Payever\Sdk\Products\Http\MessageEntity\ProductVariantOptionEntity;
use Payever\Sdk\Products\Http\MessageEntity\ProductInventoryEntity;

/**
 * This class represents ProductRequest
 *
 * @method string                             getExternalId()
 * @method string[]                           getImages()
 * @method string[]                           getImagesUrl()
 * @method bool                               getActive()
 * @method string                             getUuid()
 * @method string                             getBusinessUuid()
 * @method ProductCategoryEntity[]|string[]   getCategories()
 * @method string                             getCurrency()
 * @method string                             getTitle()
 * @method string                             getDescription()
 * @method float                              getPrice()
 * @method float|null                         getSalePrice()
 * @method bool                               getOnSales()
 * @method string                             getBarcode()
 * @method float                              getVatRate()
 * @method ProductVariantOptionEntity[]|array getOptions()
 * @method string                             getType()
 * @method string                             getCountry()
 * @method string                             getLanguage()
 * @method self[]|array                       getVariants()
 * @method ProductShippingEntity|null         getShipping()
 * @method \DateTime|false                    getCreatedAt()
 * @method \DateTime|false                    getUpdatedAt()
 * @method string|null                        getParent()
 * @method string|null                        getProduct()
 * @method $this                              setExternalId(string $externalId)
 * @method $this                              setImages(array $images)
 * @method $this                              setImagesUrl(array $imagesUrl)
 * @method $this                              setActive(bool $active)
 * @method $this                              setUuid(string $uuid)
 * @method $this                              setBusinessUuid(string $businessUuid)
 * @method $this                              setCurrency(string $currency)
 * @method $this                              setTitle(string $title)
 * @method $this                              setDescription(string $description)
 * @method $this                              setPrice(float $price)
 * @method $this                              setOnSales(bool $onSales)
 * @method $this                              setSku(string $sku)
 * @method $this                              setBarcode(string $barcode)
 * @method $this                              setVatRate(float $vatRate)
 * @method $this                              setType(string $type)
 * @method $this                              setCountry(string $country)
 * @method $this                              setLanguage(string $language)
 *
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class ProductRequest extends RequestEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    const API_DATA_CONTAINER_NAME = 'product';

    /**
     * Subscription external id.
     * Required for all requests.
     *
     * @var string $externalId
     */
    protected $externalId;

    /** @var array $images */
    protected $images = [];

    /** @var array $imagesUrl */
    protected $imagesUrl = [];

    /** @var bool $active */
    protected $active = true;

    /** @var string $country */
    protected $country;

    /** @var string $language */
    protected $language;

    /** @var string $uuid */
    protected $uuid;

    /** @var string $businessUuid */
    protected $businessUuid;

    /** @var ProductCategoryEntity[]|string[] $categories */
    protected $categories = [];

    /** @var string $currency */
    protected $currency;

    /** @var string $title */
    protected $title;

    /** @var string $description */
    protected $description;

    /** @var float $price */
    protected $price;

    /** @var float|null $salePrice */
    protected $salePrice;

    /** @var bool $onSales */
    protected $onSales = false;

    /** @var string $sku */
    protected $sku;

    /** @var string $barcode */
    protected $barcode;

    /** @var string $type */
    protected $type;

    /** @var float $vatRate */
    protected $vatRate;

    /** @var self[]|array $variants */
    protected $variants = [];

    /** @var null|ProductInventoryEntity $inventory */
    protected $inventory;

    /**
     * Parent product id for variants.
     * Present only in request with a single variant data inside.
     *
     * @var string|null $parent
     */
    protected $parent;

    /**
     * Parent product id for variants.
     * Present only in request with parent product with variants.
     *
     * @var string|null $product
     */
    protected $product;

    /** @var ProductShippingEntity|null $shipping */
    protected $shipping;

    /** @var \DateTime|bool $createdAt */
    protected $createdAt;

    /** @var \DateTime|bool $updatedAt */
    protected $updatedAt;

    /**
     * Available only for product variants
     *
     * @var ProductVariantOptionEntity[]|array $options
     */
    protected $options = [];

    /**
     * @param string $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = date_create($updatedAt);

        return $this;
    }

    /**
     * @param string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = date_create($createdAt);

        return $this;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setShipping($data)
    {
        $this->shipping = new ProductShippingEntity($data);

        return $this;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setCategories($data)
    {
        foreach ($data as $plainCategory) {
            /** Both ProductCategoryEntity fields array and simple title are possible */
            $this->categories[] = is_array($plainCategory)
                ? new ProductCategoryEntity($plainCategory)
                : $plainCategory;
        }

        return $this;
    }

    /**
     * @param array[]|static[] $data
     *
     * @return $this
     */
    public function setVariants($data)
    {
        foreach ($data as $variant) {
            $this->addVariant($variant);
        }

        return $this;
    }

    /**
     * @param array|static $variant
     *
     * @return $this
     */
    public function addVariant($variant)
    {
        if (is_array($variant)) {
            $variant = new static($variant);
            $variant->setCurrency($this->getCurrency());
        }

        $this->variants[] = $variant;

        return $this;
    }

    /**
     * @param array|ProductInventoryEntity $inventory
     *
     * @return $this
     */
    public function setInventory($inventory)
    {
        if (is_array($inventory)) {
            $inventory = new ProductInventoryEntity($inventory);
        }

        $this->inventory = $inventory;

        return $this;
    }

    /**
     * Set product variant option
     *
     * @param array $options
     *
     * @return $this
     */
    public function setOptions($options)
    {
        if (is_array($options)) {
            foreach ($options as $option) {
                $this->options[] = new ProductVariantOptionEntity($option);
            }
        }

        return $this;
    }

    /**
     * Add product variant option
     *
     * @param string $name
     * @param string $value
     *
     * @return $this
     */
    public function addOption($name, $value)
    {
        $this->options[] = new ProductVariantOptionEntity(compact('name', 'value'));

        return $this;
    }

    /**
     * @return array
     */
    public function getImagesUuid()
    {
        return array_map(
            function ($imageName) {
                return substr($imageName, 0, strpos($imageName, '.'));
            },
            $this->getImages()
        );
    }

    /**
     * @param float $salePrice
     *
     * @return $this
     */
    public function setSalePrice($salePrice)
    {
        $this->salePrice = $salePrice;
        $this->onSales = $salePrice > 0 && (!$this->getPrice() || $this->getPrice() > $salePrice);

        return $this;
    }

    /**
     * Whether this product entity represents product variant and should be linked to a product
     *
     * @return bool
     */
    public function isVariant()
    {
        return $this->getParent() || $this->getProduct() || count($this->getOptions());
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku ? $this->sku : $this->uuid;
    }

    /**
     * @inheritdoc
     */
    public function toArray($object = null)
    {
        $isRootObject = $object === null;
        $result = parent::toArray($object);
        if ($result && $isRootObject) {
            $result['salePrice'] = $this->salePrice;
            $result = array(self::API_DATA_CONTAINER_NAME => $result);
        }

        return $result;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function load($data)
    {
        if (array_key_exists(self::API_DATA_CONTAINER_NAME, $data)) {
            $data = $data[self::API_DATA_CONTAINER_NAME];
        }

        return parent::load($data);
    }
}
