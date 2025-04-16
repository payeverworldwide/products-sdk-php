<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  MessageEntity
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\ThirdParty\Http\MessageEntity;

use Payever\Sdk\Core\Base\MessageEntity;

/**
 * This class represents SubscriptionSettingSyncScheduleEntity
 *
 * @method string getCronPhrase()
 * @method string getIntegration()
 * @method self   setCronPhrase(string $expression)
 * @method self   setIntegration(string $integration)
 */
class SubscriptionSettingSyncScheduleEntity extends MessageEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /** @var string $cronPhrase */
    protected $cronPhrase;

    /** @var string $integration */
    protected $integration;

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'cronPhrase',
            'integration'
        ];
    }
}
