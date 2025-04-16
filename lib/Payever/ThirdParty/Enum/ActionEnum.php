<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Enum
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\ThirdParty\Enum;

use Payever\Sdk\Core\Base\EnumerableConstants;

/**
 * Represents available payever actions
 */
class ActionEnum extends EnumerableConstants
{
    const ACTION_CREATE_PRODUCT      = 'create-product';
    const ACTION_UPDATE_PRODUCT      = 'update-product';
    const ACTION_REMOVE_PRODUCT      = 'remove-product';
    const ACTION_ADD_INVENTORY       = 'add-inventory';
    const ACTION_SET_INVENTORY       = 'set-inventory';
    const ACTION_SUBTRACT_INVENTORY  = 'subtract-inventory';
    const ACTION_PRODUCTS_SYNC       = 'products-sync';
}
