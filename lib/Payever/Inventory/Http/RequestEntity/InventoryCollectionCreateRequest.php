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

namespace Payever\Sdk\Inventory\Http\RequestEntity;

use Payever\Sdk\Core\Http\MessageEntity\RequestEntity;

/**
 * This class represents InventoryChangedRequest
 *
 * @method string getExternalId()
 * @method $this  setExternalId(string $externalId)
 */
class InventoryCollectionCreateRequest extends RequestEntity
{
    const API_DATA_CONTAINER_NAME = 'inventories';

    /** @var array $inventories */
    protected $inventories = array();

    /** @var string $externalId */
    protected $externalId;

    /**
     * @param InventoryCreateRequest $inventory
     *
     * @return $this
     */
    public function addInventory(InventoryCreateRequest $inventory)
    {
        $this->inventories[] = $inventory;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray($object = null)
    {
        $result = array(self::API_DATA_CONTAINER_NAME => array());

        foreach ($this->inventories as $inventory) {
            $result[self::API_DATA_CONTAINER_NAME][] = $inventory->toArray($inventory);
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'externalId',
            'inventories',
        ];
    }
}
