<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  ResponseEntity
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\ThirdParty\Http\ResponseEntity;

use Payever\Sdk\Core\Http\MessageEntity\ResponseEntity;

/**
 * This class represents BusinessResponse
 */
class BusinessResponse extends ResponseEntity
{
    /** @var array $subscriptions */
    protected $subscriptions;

    /** @var string $name */
    protected $name;

    /** @var string $currency */
    protected $currency;

    /** @var array $companyAddress */
    protected $companyAddress;

    /** @var array $contactDetails */
    protected $contactDetails;

    /** @var array $bankAccount */
    protected $bankAccount;

    /** @var array $contactEmails */
    protected $contactEmails;
}
