<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  RequestEntity
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\ThirdParty\Http\RequestEntity;

use Payever\Sdk\Core\Enum\ChannelSet;
use Payever\Sdk\Core\Http\MessageEntity\RequestEntity;
use Payever\Sdk\ThirdParty\Http\MessageEntity\SubscriptionActionEntity;
use Payever\Sdk\ThirdParty\Http\MessageEntity\SubscriptionSettingEntity;

/**
 * This class represents SubscriptionRequest
 *
 * @method string                     getExternalId()
 * @method string                     getThirdPartyName()
 * @method string                     getBusinessUuid()
 * @method bool                       getIsProductSyncEnable()
 * @method SubscriptionActionEntity[] getActions()
 * @method SubscriptionSettingEntity  getSetting()
 * @method $this                      setExternalId(string $externalId)
 * @method $this                      setThirdPartyName(string $name)
 * @method $this                      setBusinessUuid(string $businessUuid)
 * @method $this                      setIsProductSyncEnable(bool $state)
 * @method $this                      setActions(SubscriptionActionEntity[] $actions)
 * @method $this                      setSetting(SubscriptionSettingEntity $setting)
 */
class SubscriptionRequest extends RequestEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /** @var string $businessUuid */
    protected $businessUuid;

    /** @var string $externalId */
    protected $externalId;

    /** @var bool $isProductSyncEnable */
    protected $isProductSyncEnable;

    /** @var string $thirdPartyName - {@see ChannelSet} */
    protected $thirdPartyName;

    /** @var SubscriptionActionEntity[] $actions */
    protected $actions = [];

    /** @var SubscriptionSettingEntity $setting */
    protected $setting;

    /**
     * @param SubscriptionActionEntity $actionEntity
     *
     * @return $this
     */
    public function addAction(SubscriptionActionEntity $actionEntity)
    {
        $this->actions[] = $actionEntity;

        return $this;
    }

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'businessUuid',
            'thirdPartyName',
            'isProductSyncEnable',
            'actions',
            'setting'
        ];
    }
}
