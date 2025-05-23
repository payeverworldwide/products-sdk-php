<?php

namespace Payever\Tests\Unit\Payever\Inventory\Http\RequestEntity;

use Payever\Sdk\Inventory\Http\RequestEntity\InventoryChangedRequest;
use Payever\Tests\Unit\Payever\Core\Http\AbstractMessageEntityTest;

class InventoryChangedRequestTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'quantity' => 10,
        'sku' => 'stub_sku',
        'externalId' => 'stub_id',
    );

    public function getEntity()
    {
        return new InventoryChangedRequest();
    }
}
