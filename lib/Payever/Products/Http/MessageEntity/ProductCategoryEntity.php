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
 * This class represents ProductCategoryEntity
 *
 * @method string getId()
 * @method string getBusinessUuid()
 * @method string getTitle()
 * @method string getSlug()
 * @method string setId(string $id)
 * @method $this  setBusinessUuid(string $businessUuid)
 * @method $this  setTitle(string $title)
 * @method $this  setSlug(string $slug)
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class ProductCategoryEntity extends MessageEntity
{
    /** @var string $id */
    protected $id;

    /** @var string $businessUuid */
    protected $businessUuid;

    /** @var string $title */
    protected $title;

    /** @var string $slug */
    protected $slug;
}
