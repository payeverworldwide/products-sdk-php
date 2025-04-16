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
 * This class represents ProductShippingEntity
 *
 * @method string getMeasureMass()
 * @method string getMeasureSize()
 * @method bool   getFree()
 * @method bool   getGeneral()
 * @method float  getWeight()
 * @method float  getWidth()
 * @method float  getLength()
 * @method float  getHeight()
 * @method $this  setMeasureMass(string $measureMass)
 * @method $this  setMeasureSize(string $measureSize)
 * @method $this  setFree(bool $free)
 * @method $this  setGeneral(bool $general)
 * @method $this  setWeight(float $weight)
 * @method $this  setWidth(float $width)
 * @method $this  setLength(float $length)
 * @method $this  setHeight(float $height)
 */
class ProductShippingEntity extends MessageEntity
{
    /** @var string $measureMass */
    protected $measureMass = 'kg';

    /** @var string $measureSize */
    protected $measureSize = 'cm';

    /** @var bool $free */
    protected $free = false;

    /** @var bool $general */
    protected $general = false;

    /** @var float $weight */
    protected $weight;

    /** @var float $width */
    protected $width;

    /** @var float $length */
    protected $length;

    /** @var float $height */
    protected $height;
}
