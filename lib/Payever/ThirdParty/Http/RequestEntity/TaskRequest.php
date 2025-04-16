<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  RequestEntity
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\ThirdParty\Http\RequestEntity;

use Payever\Sdk\Core\Http\MessageEntity\RequestEntity;

/**
 * This class represents TaskRequest
 *
 * @method string getAuthorizationId()
 * @method string getTaskId()
 * @method self   setAuthorizationId(string $authId)
 * @method self   setTaskId(string $taskId)
 */
class TaskRequest extends RequestEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /** @var string $authorizationId */
    protected $authorizationId;

    /** @var string $taskId */
    protected $taskId;

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'authorizationId',
            'taskId'
        ];
    }
}
