<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Base
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\ThirdParty\Base;

use Payever\Sdk\Core\Base\CommonApiClientInterface;
use Payever\Sdk\Core\Base\ResponseInterface;
use Payever\Sdk\Core\Http\Response;
use Payever\Sdk\ThirdParty\Http\RequestEntity\SubscriptionRequest;
use Payever\Sdk\ThirdParty\Http\RequestEntity\TaskRequest;

/**
 * Interface describes functions of ThirdPartyApiClient
 */
interface ThirdPartyApiClientInterface extends CommonApiClientInterface
{
    /**
     * Get current business entity
     *
     * @return ResponseInterface
     */
    public function getBusinessRequest();

    /**
     * Retrieves the subscription entity if client is subscribed
     *
     * @param SubscriptionRequest $subscriptionRequest
     *
     * @return Response
     */
    public function getSubscriptionStatus(SubscriptionRequest $subscriptionRequest);

    /**
     * Subscribe for a products data
     *
     * @param SubscriptionRequest $subscriptionRequest
     *
     * @return Response
     */
    public function subscribe(SubscriptionRequest $subscriptionRequest);

    /**
     * Unsubscribe from products data
     *
     * @param SubscriptionRequest $subscriptionRequest
     *
     * @return Response
     */
    public function unsubscribe(SubscriptionRequest $subscriptionRequest);

    /**
     * Get current task result entity
     *
     * @param TaskRequest $taskRequest
     *
     * @return Response
     */
    public function getTaskResult(TaskRequest $taskRequest);
}
