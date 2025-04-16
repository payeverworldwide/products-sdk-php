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

/**
 * This class represents ActionHandlerPool
 * The ActionHandlerPool manages and retrieves handlers for specific actions and scalable action processing
 *
 * @SuppressWarnings(PHPMD.MissingImport)
 */
class ActionHandlerPool
{
    /** @var ActionHandlerInterface[] $handlers */
    protected $handlers;

    /**
     * @param ActionHandlerInterface[] $handlers
     */
    public function __construct(array $handlers = [])
    {
        $this->handlers = [];
        foreach ($handlers as $handler) {
            $this->registerActionHandler($handler);
        }
    }

    /**
     * @param ActionHandlerInterface $handler
     *
     * @return $this
     */
    public function registerActionHandler(ActionHandlerInterface $handler)
    {
        $this->handlers[$handler->getSupportedAction()] = $handler;

        return $this;
    }

    /**
     * @param string $action - {@see ActionEnum}
     *
     * @return ActionHandlerInterface
     *
     * @throws \RuntimeException when can't find corresponding handler
     */
    public function getHandlerForAction($action)
    {
        if (isset($this->handlers[$action])) {
            return $this->handlers[$action];
        }

        throw new \RuntimeException(sprintf('No handler registered for %s action', $action));
    }
}
