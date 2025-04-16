<?php

namespace Payever\Tests\Unit\Payever\Products\Http\RequestEntity;

use Payever\Sdk\Products\Http\RequestEntity\ProductRemovedRequest;
use Payever\Tests\Unit\Payever\Core\Http\AbstractMessageEntityTest;

class ProductRemovedRequestTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'sku' => 'stub_sku',
        'externalId' => 'stub_id',
    );

    public function getEntity()
    {
        return new ProductRemovedRequest();
    }
}
