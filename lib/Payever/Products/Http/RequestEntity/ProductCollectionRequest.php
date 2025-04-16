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

/**
 * This class represents ProductCollectionRequest
 *
 * @method string getExternalId()
 * @method $this  setExternalId(string $externalId)
 */
class ProductCollectionRequest extends RequestEntity
{
    const API_DATA_CONTAINER_NAME = 'products';

    /** @var array $products */
    protected $products = array();

    /** @var string $externalId */
    protected $externalId;

    /**
     * @param ProductRequest $product
     *
     * @return $this
     */
    public function addProduct(ProductRequest $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray($object = null)
    {
        $result = array(self::API_DATA_CONTAINER_NAME => array());

        foreach ($this->products as $product) {
            $result[self::API_DATA_CONTAINER_NAME][] = $product->toArray($product);
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'externalId',
            'products',
        ];
    }
}
