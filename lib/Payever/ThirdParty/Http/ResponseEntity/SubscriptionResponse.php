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
use Payever\Sdk\ThirdParty\Http\MessageEntity\SubscriptionActionEntity;

/**
 * This class represents BusinessResponse
 *
 * @method string                     getId()
 * @method string                     getAuthorizationId()
 * @method string                     getIntegration()
 * @method string                     getIsProductSyncEnable()
 * @method bool                       getConnected()
 * @method \DateTime|false            getCreatedAt()
 * @method \DateTime|false            getUpdatedAt()
 * @method SubscriptionActionEntity[] getActions()
 */
class SubscriptionResponse extends ResponseEntity
{
    /**
     * @deprecated use $authorizationId instead
     *
     * @var string $externalId
     */
    protected $externalId;

    /**
     * Field value must be saved by user for further use in sync-related requests
     *
     * @var string $authorizationId
     */
    protected $authorizationId;

    /** @var string $integration */
    protected $integration;

    /** @var bool $connected */
    protected $connected;

    /** @var \DateTime|bool $createdAt */
    protected $createdAt;

    /** @var \DateTime|bool $updatedAt */
    protected $updatedAt;

    /** @var SubscriptionActionEntity[] $actions */
    protected $actions;

    /** @var bool $isProductSyncEnable */
    protected $isProductSyncEnable;

    /**
     * @deprecated use getAuthorizationId() instead
     *
     * @return string
     */
    public function getExternalId()
    {
        return null === $this->externalId
            ? $this->authorizationId
            : $this->externalId;
    }

    /**
     * @param string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        if ($createdAt) {
            $this->createdAt = date_create($createdAt);
        }

        return $this;
    }

    /**
     * @param string $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        if ($updatedAt) {
            $this->updatedAt = date_create($updatedAt);
        }

        return $this;
    }

    /**
     * @param array $actions
     *
     * @return $this
     */
    public function setActions($actions)
    {
        foreach ($actions as $plainAction) {
            $this->actions[] = new SubscriptionActionEntity($plainAction);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'authorizationId',
            'connected',
        ];
    }
}
