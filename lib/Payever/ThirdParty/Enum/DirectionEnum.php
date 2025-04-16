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
 * Represents available action directions
 */
class DirectionEnum extends EnumerableConstants
{
    const INWARD = 'inward';
    const OUTWARD = 'outward';
}
