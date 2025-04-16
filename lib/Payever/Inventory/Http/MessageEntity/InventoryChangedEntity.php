<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Inventory
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Inventory\Http\MessageEntity;

use Payever\Sdk\Core\Base\MessageEntity;

/**
 * This class represents InventoryChangedEntity
 *
 * @method string   getSku()
 * @method int|null getQuantity()
 * @method int      getStock()
 * @method $this    setSku(string $sku)
 * @method $this    setQuantity(int $quantity)
 * @method $this    setStock(int $stock)
 */
class InventoryChangedEntity extends MessageEntity
{
    /**
     * Target product SKU
     *
     * @var string
     */
    protected $sku;

    /**
     * Diff between previous and current states (+/-)
     *
     * @var int|null
     */
    protected $quantity;

    /**
     * Actual quantity after this action
     *
     * @var int
     */
    protected $stock;

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'sku',
            'stock',
        ];
    }
}
