<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Products
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Products\Http\MessageEntity;

use Payever\Sdk\Core\Base\MessageEntity;

/**
 * This class represents ProductVariantOptionEntity
 *
 * @method string getName()
 * @method string getValue()
 * @method $this  setName(string $name)
 * @method $this  setValue(string $value)
 */
class ProductVariantOptionEntity extends MessageEntity
{
    /** @var string $name */
    protected $name;

    /** @var string $value */
    protected $value;

    /**
     * @return string
     */
    public function getUnderscoreName()
    {
        return strtolower(str_replace(' ', '_', $this->name));
    }
}
