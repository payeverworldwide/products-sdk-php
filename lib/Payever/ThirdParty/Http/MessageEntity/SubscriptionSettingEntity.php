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
 * This class represents SubscriptionSettingEntity
 *
 * @method bool   getCustomCategoriesEnabled()
 * @method array  getSyncSchedules()
 * @method string getWebhookUrl()
 * @method self   setCustomCategoriesEnabled(bool $status)
 * @method self   setSyncSchedules(array $schedules)
 * @method self   setWebhookUrl(string $url)
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class SubscriptionSettingEntity extends MessageEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /** @var bool $customCategoriesEnabled */
    protected $customCategoriesEnabled = false;

    /** @var SubscriptionSettingSyncScheduleEntity[] $syncSchedules */
    protected $syncSchedules;

    /** @var string $webhookUrl */
    protected $webhookUrl;

    /**
     * @param SubscriptionSettingSyncScheduleEntity $schedule
     *
     * @return $this
     */
    public function addSchedule(SubscriptionSettingSyncScheduleEntity $schedule)
    {
        $this->syncSchedules[] = $schedule;

        return $this;
    }

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'customCategoriesEnabled',
            'syncSchedules',
            'webhookUrl',
        ];
    }
}
