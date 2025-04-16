<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Inventory
 * @package   Payever\Inventory
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Inventory\Base;

use Payever\Sdk\Core\Http\Response;
use Payever\Sdk\Inventory\Http\RequestEntity\InventoryChangedRequest;
use Payever\Sdk\Inventory\Http\RequestEntity\InventoryCollectionCreateRequest;
use Payever\Sdk\Inventory\Http\RequestEntity\InventoryCreateRequest;

/**
 * Interface describes functions of InventoryApiClient
 */
interface InventoryApiClientInterface
{
    /**
     * Create an inventory record on payever side.
     *
     * Only first request will actually create an inventory record for SKU,
     * all subsequent requests will be ignored.
     *
     * @param InventoryCreateRequest $inventoryRequest
     *
     * @return Response
     */
    public function createInventory(InventoryCreateRequest $inventoryRequest);

    /**
     * @param InventoryCollectionCreateRequest $inventoryRequest
     *
     * @return Response
     */
    public function createOrUpdateInventoryCollection(InventoryCollectionCreateRequest $inventoryRequest);

    /**
     * Inform payever about increased inventory for product
     *
     * @param InventoryChangedRequest $inventoryRequest
     *
     * @return Response
     */
    public function addInventory(InventoryChangedRequest $inventoryRequest);

    /**
     * Inform payever about decreased inventory for product
     *
     * @param InventoryChangedRequest $inventoryRequest
     *
     * @return Response
     */
    public function subtractInventory(InventoryChangedRequest $inventoryRequest);

    /**
     * Batch export inventory records to payever
     *
     * @param InventoryIteratorInterface $inventoryIterator
     * @param string $externalId
     *
     * @return int - Number of successfully exported records
     */
    public function exportInventory(InventoryIteratorInterface $inventoryIterator, $externalId);
}
