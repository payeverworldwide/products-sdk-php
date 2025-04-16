<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Action
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\ThirdParty\Action;

use Payever\Sdk\Inventory\Http\RequestEntity\InventoryChangedRequest;
use Payever\Sdk\Products\Http\RequestEntity\ProductRemovedRequest;
use Payever\Sdk\Products\Http\RequestEntity\ProductRequest;

/**
 * This class represents BidirectionalActionProcessor
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class BidirectionalActionProcessor
{
    /** @var InwardActionProcessor $inwardActionProcessor */
    private $inwardActionProcessor;

    /** @var OutwardActionProcessor $outwardActionProcessor */
    private $outwardActionProcessor;

    /**
     * @param InwardActionProcessor  $inwardActionProcessor
     * @param OutwardActionProcessor $outwardActionProcessor
     */
    public function __construct(
        InwardActionProcessor $inwardActionProcessor,
        OutwardActionProcessor $outwardActionProcessor
    ) {
        $this->inwardActionProcessor = $inwardActionProcessor;
        $this->outwardActionProcessor = $outwardActionProcessor;
    }

    /**
     * Do the job of processing payever third-party action request
     *
     * @param string            $action - {@see ActionEnum}
     * @param array|string|null $payload - user can pass payload directly if it's coming from custom source
     *
     * @throws \Exception - bubbles up anything thrown inside
     */
    public function processInwardAction($action, $payload = null)
    {
        $this->inwardActionProcessor->process($action, $payload);
    }

    /**
     * @param string $action - {@see ActionEnum}
     * @param InventoryChangedRequest|ProductRequest|ProductRemovedRequest|array|string $payload
     *
     * @throws \RuntimeException - when given action is unknown
     * @throws \Exception - bubbles up anything thrown by API
     */
    public function processOutwardAction($action, $payload)
    {
        $this->outwardActionProcessor->process($action, $payload);
    }
}
