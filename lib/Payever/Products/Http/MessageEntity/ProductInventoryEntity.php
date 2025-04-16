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

namespace Payever\Sdk\Products\Http\MessageEntity;

use Payever\Sdk\Core\Base\MessageEntity;

/**
 * This class represents ProductInventoryEntity
 *
 * @method string     getSku()
 * @method int        getStock()
 * @method $this      setSku(string $sku)
 * @method $this      setStock(int $stock)
 */
class ProductInventoryEntity extends MessageEntity
{
    /** @var string $sku */
    protected $sku;

    /** @var int $stock */
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
