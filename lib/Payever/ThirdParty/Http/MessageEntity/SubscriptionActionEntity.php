<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  MessageEntity
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\ThirdParty\Http\MessageEntity;

use Payever\Sdk\Core\Base\MessageEntity;
use Payever\Sdk\ThirdParty\Enum\ActionEnum;

/**
 * This class represents SubscriptionActionEntity
 *
 * @method string getName()
 * @method string getUrl()
 * @method string getMethod()
 * @method $this  setName(string $name)
 * @method $this  setUrl(string $url)
 * @method $this  setMethod(string $httpMethod)
 */
class SubscriptionActionEntity extends MessageEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /** @var string $name - {@see ActionEnum} */
    protected $name;

    /** @var string $url */
    protected $url;

    /** @var string $method */
    protected $method;

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'name',
            'url',
            'method',
        ];
    }
}
