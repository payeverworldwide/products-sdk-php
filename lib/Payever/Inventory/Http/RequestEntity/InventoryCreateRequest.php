<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  RequestEntity
 * @package   Payever\Inventory
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Inventory\Http\RequestEntity;

use Payever\Sdk\Core\Http\MessageEntity\RequestEntity;

/**
 * This class represents InventoryCreateRequest
 *
 * @method string getSku()
 * @method int    getStock()
 * @method string getExternalId()
 * @method $this  setExternalId(string $externalId)
 */
class InventoryCreateRequest extends RequestEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /**
     * Subscription external id.
     * Required for all requests.
     *
     * @var string
     */
    protected $externalId;

    /**
     * Target product SKU
     *
     * @var string
     */
    protected $sku;

    /**
     * Initial qty of a product.
     * Only first request will actually create an inventory record on payever side.
     * All further create requests will be ignored.
     *
     * @var int
     */
    protected $stock;

    /**
     * @param string $sku
     *
     * @return $this
     */
    public function setSku($sku)
    {
        $this->sku = (string) $sku;

        return $this;
    }

    /**
     * @param int|float|string $stock
     *
     * @return $this
     */
    public function setStock($stock)
    {
        $this->stock = (int) $stock;

        return $this;
    }

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'externalId',
            'sku',
            'stock',
        ];
    }
}
