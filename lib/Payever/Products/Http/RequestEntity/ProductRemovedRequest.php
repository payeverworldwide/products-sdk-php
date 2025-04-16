<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  RequestEntity
 * @package   Payever\Products
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Products\Http\RequestEntity;

use Payever\Sdk\Core\Http\MessageEntity\RequestEntity;

/**
 * This class represents ProductRemovedRequest
 * When sending entity to payever at least one of the following MUST be filled in: sku, uuid
 *
 * @method string getExternalId()
 * @method string getUuid()
 * @method string getSku()
 * @method $this  setExternalId(string $externalId)
 * @method $this  setSku(string $sku)
 * @method $this  setUuid(string $uuid)
 */
class ProductRemovedRequest extends RequestEntity
{
    /** @var string $externalId */
    protected $externalId;

    /** @var array $uuid */
    protected $uuid;

    /** @var string $sku */
    protected $sku;

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'externalId',
            'sku',
        ];
    }
}
