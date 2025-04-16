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
 * Interface describes functions of ActionHandler
 */
interface ActionHandlerInterface
{
    /**
     * Must tell us what action this handler intends to handle.
     *
     * @see ActionEnum
     *
     * @return string
     */
    public function getSupportedAction();

    /**
     * Must handle action and throw exception if anything goes wrong.
     *
     * @param ActionPayload $actionPayload
     * @param ActionResult  $actionResult
     *
     * @return void - All results must be represented through given ActionResult instance
     *
     * @throws \Exception - when action couldn't be handled, must have meaningful message
     */
    public function handle(ActionPayload $actionPayload, ActionResult $actionResult);
}
