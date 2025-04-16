<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Inventory
 * @package   Payever\Inventory
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Inventory\Base;

use Payever\Sdk\Inventory\Http\RequestEntity\InventoryCreateRequest;

/**
 * Interface describes functions of InventoryIterator
 * Implement this interface in order to batch export inventory info to payever
 *
 * @see InventoryApiClientInterface::exportInventory()
 */
interface InventoryIteratorInterface extends \Iterator
{
    /**
     * @return InventoryCreateRequest
     */
    #[\ReturnTypeWillChange]
    public function current();
}
