<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  ThirdParty
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\ThirdParty;

use Payever\Sdk\Core\Http\RequestBuilder;
use Payever\Sdk\Core\Http\ResponseEntity\DynamicResponse;
use Payever\Sdk\ThirdParty\Base\ThirdPartyApiClientInterface;
use Payever\Sdk\ThirdParty\Http\RequestEntity\SubscriptionRequest;
use Payever\Sdk\ThirdParty\Http\RequestEntity\TaskRequest;
use Payever\Sdk\ThirdParty\Http\ResponseEntity\BusinessResponse;
use Payever\Sdk\ThirdParty\Http\ResponseEntity\SubscriptionResponse;

/**
 * This class represents payever ThirdParty API Connector
 * ThirdPartyApiClient handles integration requests like subscription, unsubscription, and business info retrieval
 */
class ThirdPartyApiClient extends CommonProductsThirdPartyApiClient implements ThirdPartyApiClientInterface
{
    const SUB_URL_BUSINESS_INFO = 'api/business/%s/plugins';
    const SUB_URL_CONNECTION = 'api/business/%s/connection/authorization/%s';
    const SUB_URL_INTEGRATION = 'api/connection/business/%s/integration/%s';
    const SUB_URL_TASK = 'api/synchronization/%s/task/%s';

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function getBusinessRequest()
    {
        $this->getConfiguration()->assertLoaded();

        $request = RequestBuilder::get($this->getBusinessInfoUrl($this->getConfiguration()->getBusinessUuid()))
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setResponseEntity(new BusinessResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function getSubscriptionStatus(SubscriptionRequest $subscriptionRequest)
    {
        $this->getConfiguration()->assertLoaded();

        $this->fillSubscriptionEntityFromConfiguration($subscriptionRequest);

        $request = RequestBuilder::get($this->getConnectionUrl($subscriptionRequest))
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setResponseEntity(new SubscriptionResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function subscribe(SubscriptionRequest $subscriptionRequest)
    {
        $this->getConfiguration()->assertLoaded();

        $this->fillSubscriptionEntityFromConfiguration($subscriptionRequest);
        $subscriptionRequest->setIsProductSyncEnable(true);

        $request = RequestBuilder::post($this->getIntegrationUrl($subscriptionRequest))
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($subscriptionRequest)
            ->setResponseEntity(new SubscriptionResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function unsubscribe(SubscriptionRequest $subscriptionRequest)
    {
        $this->getConfiguration()->assertLoaded();

        $this->fillSubscriptionEntityFromConfiguration($subscriptionRequest);
        $subscriptionRequest->setIsProductSyncEnable(false);

        $request = RequestBuilder::delete($this->getConnectionUrl($subscriptionRequest))
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function getTaskResult(TaskRequest $taskRequest)
    {
        $this->getConfiguration()->assertLoaded();

        $request = RequestBuilder::get($this->getTaskUrl($taskRequest))
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @param string $businessUuid
     *
     * @return string
     */
    protected function getBusinessInfoUrl($businessUuid)
    {
        return $this->getBaseUrl() . sprintf(static::SUB_URL_BUSINESS_INFO, $businessUuid);
    }

    /**
     * @param SubscriptionRequest $requestEntity
     *
     * @return string
     */
    protected function getConnectionUrl(SubscriptionRequest $requestEntity)
    {
        $path = sprintf(
            static::SUB_URL_CONNECTION,
            $requestEntity->getBusinessUuid(),
            $requestEntity->getExternalId()
        );

        return $this->getBaseUrl() . $path;
    }

    /**
     * @param SubscriptionRequest $requestEntity
     *
     * @return string
     */
    protected function getIntegrationUrl(SubscriptionRequest $requestEntity)
    {
        $path = sprintf(
            static::SUB_URL_INTEGRATION,
            $requestEntity->getBusinessUuid(),
            $requestEntity->getThirdPartyName()
        );

        return $this->getBaseUrl() . $path;
    }

    /**
     * @param TaskRequest $requestEntity
     *
     * @return string
     */
    protected function getTaskUrl(TaskRequest $requestEntity)
    {
        $path = sprintf(
            static::SUB_URL_TASK,
            $requestEntity->getAuthorizationId(),
            $requestEntity->getTaskId()
        );

        return $this->getBaseUrl() . $path;
    }

    /**
     * @param SubscriptionRequest $requestEntity
     */
    private function fillSubscriptionEntityFromConfiguration(SubscriptionRequest $requestEntity)
    {
        if (!$requestEntity->getBusinessUuid()) {
            $requestEntity->setBusinessUuid($this->getConfiguration()->getBusinessUuid());
        }
        if (!$requestEntity->getThirdPartyName()) {
            $requestEntity->setThirdPartyName($this->getConfiguration()->getChannelSet());
        }
    }
}
