<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Core
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\ThirdParty;

use Payever\Sdk\Core\CommonApiClient;

/**
 * This class represents CommonProductsThirdPartyApiClient
 */
class CommonProductsThirdPartyApiClient extends CommonApiClient
{
    const URL_SANDBOX = 'https://products-third-party.staging.devpayever.com/';
    const URL_LIVE    = 'https://products-third-party.payever.org/';
}
