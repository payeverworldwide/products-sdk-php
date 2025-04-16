<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Base
 * @package   Payever\Products
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Products\Base;

use Payever\Sdk\Products\Http\RequestEntity\ProductRequest;

/**
 * Interface describes functions of ProductsIterator
 * Implement this interface in order to batch export products to payever
 *
 * @see ProductsApiClientInterface::exportProducts()
 */
interface ProductsIteratorInterface extends \Iterator
{
    /**
     * @return ProductRequest
     */
    #[\ReturnTypeWillChange]
    public function current();
}
