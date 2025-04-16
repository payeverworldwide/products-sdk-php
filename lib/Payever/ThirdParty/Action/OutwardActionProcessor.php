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
use Payever\Sdk\Inventory\Http\RequestEntity\InventoryCollectionCreateRequest;
use Payever\Sdk\Inventory\Http\RequestEntity\InventoryCreateRequest;
use Payever\Sdk\Inventory\InventoryApiClient;
use Payever\Sdk\Products\Http\RequestEntity\ProductCollectionRequest;
use Payever\Sdk\Products\Http\RequestEntity\ProductRemovedRequest;
use Payever\Sdk\Products\Http\RequestEntity\ProductRequest;
use Payever\Sdk\Products\ProductsApiClient;
use Payever\Sdk\ThirdParty\Enum\ActionEnum;
use Psr\Log\LoggerInterface;

/**
 * This class represents OutwardActionProcessor
 * The OutwardActionProcessor processes outbound API actions for inventory and products
 *
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.MissingImport)
 */
class OutwardActionProcessor
{
    /** @var ProductsApiClient $productsApiClient */
    private $productsApiClient;

    /** @var InventoryApiClient $inventoryApiClient */
    private $inventoryApiClient;

    /** @var LoggerInterface $logger */
    private $logger;

    /**
     * @param ProductsApiClient  $productsApiClient
     * @param InventoryApiClient $inventoryApiClient
     * @param LoggerInterface    $logger
     */
    public function __construct(
        ProductsApiClient $productsApiClient,
        InventoryApiClient $inventoryApiClient,
        LoggerInterface $logger
    ) {
        $this->productsApiClient = $productsApiClient;
        $this->inventoryApiClient = $inventoryApiClient;
        $this->logger = $logger;
    }

    /**
     * @param string $action - {@see ActionEnum}
     * @param InventoryChangedRequest|ProductRequest|ProductRemovedRequest|array|string $payload
     *
     * @throws \RuntimeException - when given action is unknown
     * @throws \Exception - bubbles up anything thrown by API
     */
    public function process($action, $payload)
    {
        $loggerPrefix = '[OUTWARD_ACTION_REQUEST]';

        $this->logger->info(
            sprintf('%s Processing action request', $loggerPrefix),
            compact('action')
        );

        $this->logger->debug(
            sprintf('%s Action request payload', $loggerPrefix),
            compact('action', 'payload')
        );

        try {
            $this->executeActionRequest($action, $payload);
        } catch (\Exception $exception) {
            $this->logger->critical(
                sprintf(
                    '%s Processing action failed. EXCEPTION: %s: %s',
                    $loggerPrefix,
                    $exception->getCode(),
                    $exception->getMessage()
                ),
                compact('action', 'payload')
            );

            throw $exception;
        }
    }

    /**
     * @param string $action - {@see ActionEnum}
     * @param InventoryChangedRequest|ProductRequest|ProductRemovedRequest|array|string $payload
     *
     * @throws \Exception
     */
    private function executeActionRequest($action, $payload)
    {
        if (is_string($payload)) {
            $payload = json_decode($payload, true);
        }
        switch ($action) {
            case ActionEnum::ACTION_SET_INVENTORY:
                if ($payload instanceof InventoryCollectionCreateRequest) {
                    $this->inventoryApiClient->createOrUpdateInventoryCollection($payload);
                    break;
                }

                $this->inventoryApiClient->createInventory(
                    $payload instanceof InventoryCreateRequest
                        ? $payload
                        : new InventoryCreateRequest($payload)
                );
                break;
            case ActionEnum::ACTION_ADD_INVENTORY:
                if ($payload instanceof InventoryCollectionCreateRequest) {
                    $this->inventoryApiClient->createOrUpdateInventoryCollection($payload);
                    break;
                }

                $this->inventoryApiClient->addInventory(
                    $payload instanceof InventoryChangedRequest
                        ? $payload
                        : new InventoryChangedRequest($payload)
                );
                break;
            case ActionEnum::ACTION_SUBTRACT_INVENTORY:
                $this->inventoryApiClient->subtractInventory(
                    $payload instanceof InventoryChangedRequest
                        ? $payload
                        : new InventoryChangedRequest($payload)
                );
                break;
            case ActionEnum::ACTION_CREATE_PRODUCT:
            case ActionEnum::ACTION_UPDATE_PRODUCT:
                if ($payload instanceof ProductCollectionRequest) {
                    $this->productsApiClient->createOrUpdateProductCollection($payload);
                    break;
                }

                $this->productsApiClient->createOrUpdateProduct(
                    $payload instanceof ProductRequest ? $payload : new ProductRequest($payload)
                );
                break;
            case ActionEnum::ACTION_REMOVE_PRODUCT:
                $this->productsApiClient->removeProduct(
                    $payload instanceof ProductRemovedRequest
                        ? $payload
                        : new ProductRemovedRequest($payload)
                );
                break;
            default:
                throw new \RuntimeException(sprintf('Unknown action %s', $action));
        }
    }
}
