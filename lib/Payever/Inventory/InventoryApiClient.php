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

namespace Payever\Sdk\Inventory;

use Payever\Sdk\Core\Http\RequestBuilder;
use Payever\Sdk\Core\Http\ResponseEntity\DynamicResponse;
use Payever\Sdk\Inventory\Base\InventoryApiClientInterface;
use Payever\Sdk\Inventory\Base\InventoryIteratorInterface;
use Payever\Sdk\Inventory\Http\RequestEntity\InventoryChangedRequest;
use Payever\Sdk\Inventory\Http\RequestEntity\InventoryCollectionCreateRequest;
use Payever\Sdk\Inventory\Http\RequestEntity\InventoryCreateRequest;
use Payever\Sdk\ThirdParty\CommonProductsThirdPartyApiClient;

/**
 * This class represents payever Inventory API Connector
 * InventoryApiClient handles inventory operations, including creating, adding, subtracting, and exporting inventory
 */
class InventoryApiClient extends CommonProductsThirdPartyApiClient implements InventoryApiClientInterface
{
    const SUB_URL_INVENTORY_CREATE = 'api/inventory/%s';
    const SUB_URL_INVENTORY_ADD = 'api/inventory/%s/add';
    const SUB_URL_INVENTORY_SUBTRACT = 'api/inventory/%s/subtract';

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function createInventory(InventoryCreateRequest $inventoryRequest)
    {
        $this->getConfiguration()->assertLoaded();
        $url = $this->getCreateInventoryUrl($inventoryRequest->getExternalId());

        $request = RequestBuilder::post($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($inventoryRequest)
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function createOrUpdateInventoryCollection(InventoryCollectionCreateRequest $inventoryRequest)
    {
        $this->getConfiguration()->assertLoaded();
        $url = $this->getCreateInventoryUrl($inventoryRequest->getExternalId());

        $request = RequestBuilder::put($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($inventoryRequest)
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function addInventory(InventoryChangedRequest $inventoryRequest)
    {
        $this->getConfiguration()->assertLoaded();
        $url = $this->getAddInventoryUrl($inventoryRequest->getExternalId());

        $request = RequestBuilder::post($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($inventoryRequest)
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function subtractInventory(InventoryChangedRequest $inventoryRequest)
    {
        $this->getConfiguration()->assertLoaded();
        $url = $this->getSubtractInventoryUrl($inventoryRequest->getExternalId());

        $request = RequestBuilder::post($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($inventoryRequest)
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function exportInventory(InventoryIteratorInterface $inventoryIterator, $externalId)
    {
        $this->getConfiguration()->assertLoaded();
        $successCount = 0;

        $inventoryCollection = new InventoryCollectionCreateRequest();
        $inventoryCollection->setExternalId($externalId);

        foreach ($inventoryIterator as $requestEntity) {
            $requestEntity->setExternalId($externalId);
            $inventoryCollection->addInventory($requestEntity);
        }

        $this->createOrUpdateInventoryCollection($inventoryCollection);

        return $successCount;
    }

    /**
     * @param string $externalId
     *
     * @return string
     */
    private function getCreateInventoryUrl($externalId)
    {
        return $this->getBaseUrl() . sprintf(static::SUB_URL_INVENTORY_CREATE, $externalId);
    }

    /**
     * @param string $externalId
     *
     * @return string
     */
    private function getAddInventoryUrl($externalId)
    {
        return $this->getBaseUrl() . sprintf(static::SUB_URL_INVENTORY_ADD, $externalId);
    }

    /**
     * @param string $externalId
     *
     * @return string
     */
    private function getSubtractInventoryUrl($externalId)
    {
        return $this->getBaseUrl() . sprintf(static::SUB_URL_INVENTORY_SUBTRACT, $externalId);
    }
}
