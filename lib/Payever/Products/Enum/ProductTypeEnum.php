<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Enum
 * @package   Payever\Products
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Products\Enum;

/**
 * Represents available payever product types
 */
class ProductTypeEnum
{
    const TYPE_PHYSICAL = 'physical';
    const TYPE_DIGITAL  = 'digital';
    const TYPE_SERVICE  = 'service';
}
