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

use Payever\Sdk\Core\Base\MessageEntity;
use Payever\Sdk\Inventory\Http\MessageEntity\InventoryChangedEntity;
use Payever\Sdk\Products\Http\RequestEntity\ProductRemovedRequest;
use Payever\Sdk\Products\Http\RequestEntity\ProductRequest;
use Payever\Sdk\ThirdParty\Enum\ActionEnum;

/**
 * This class represents ActionPayload
 * The ActionPayload class processes action-based payloads by mapping them to specific entities
 *
 * @SuppressWarnings(PHPMD.MissingImport)
 */
class ActionPayload
{
    /** @var string $action */
    protected $action;

    /** @var bool|string|array $rawPayload */
    protected $rawPayload;

    /**
     * @param string            $action - {@see ActionEnum}
     * @param string|array|null $rawPayload
     */
    public function __construct($action, $rawPayload = null)
    {
        $this->action = $action;
        $this->rawPayload = $rawPayload;
    }

    /**
     * @return MessageEntity
     *
     * @throws \UnexpectedValueException when can't fetch request payload
     * @throws \RuntimeException when can't map action to payload entity
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ElseExpression)
     */
    public function getPayloadEntity()
    {
        if (!$this->rawPayload) {
            $this->rawPayload = $this->getRequestPayload();
        }

        if (!$this->rawPayload) {
            throw new \UnexpectedValueException('Got empty action request payload.', 40);
        }

        if (is_string($this->rawPayload)) {
            $payload = $this->unserializePayload($this->rawPayload);
        } else {
            $payload = $this->rawPayload;
        }

        if (isset($payload['data'])) {
            $payload = $payload['data'];
        }

        switch ($this->action) {
            case ActionEnum::ACTION_CREATE_PRODUCT:
            case ActionEnum::ACTION_UPDATE_PRODUCT:
                return new ProductRequest($payload);
            case ActionEnum::ACTION_REMOVE_PRODUCT:
                return new ProductRemovedRequest($payload);
            case ActionEnum::ACTION_ADD_INVENTORY:
            case ActionEnum::ACTION_SET_INVENTORY:
            case ActionEnum::ACTION_SUBTRACT_INVENTORY:
                return new InventoryChangedEntity($payload);
            default:
                throw new \RuntimeException(
                    sprintf('Payload entity not found for action %s', $this->action),
                    41
                );
        }
    }

    /**
     * @return false|array|string
     */
    public function getRawPayload()
    {
        return $this->rawPayload ?: $this->getRequestPayload();
    }

    /**
     * @param string $payload
     *
     * @return array
     */
    protected function unserializePayload($payload)
    {
        return json_decode($payload, true);
    }

    /**
     * @return false|string
     */
    protected function getRequestPayload()
    {
        return file_get_contents('php://input');
    }
}
