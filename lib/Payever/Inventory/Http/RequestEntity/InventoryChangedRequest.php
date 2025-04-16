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
 * This class represents InventoryChangedRequest
 *
 * @method string getSku()
 * @method int    getQuantity()
 * @method string getExternalId()
 * @method $this  setQuantity(int $quantity)
 * @method $this  setExternalId(string $externalId)
 */
class InventoryChangedRequest extends RequestEntity
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
     * Unsigned diff between previous and current states.
     * Addition or subtraction is indicated by endpoint this entity sent to.
     *
     * @var int
     */
    protected $quantity;

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
     * @return array
     */
    public function getRequired()
    {
        return [
            'externalId',
            'sku',
            'quantity',
        ];
    }
}
