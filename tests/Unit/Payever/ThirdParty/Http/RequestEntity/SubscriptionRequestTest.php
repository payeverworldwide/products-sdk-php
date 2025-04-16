<?php

namespace Payever\Tests\Unit\Payever\ThirdParty\Http\RequestEntity;

use Payever\Sdk\ThirdParty\Http\RequestEntity\SubscriptionRequest;
use Payever\Tests\Unit\Payever\Core\Http\AbstractMessageEntityTest;

class SubscriptionRequestTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'businessUuid' => 'stub_business',
        'externalId' => 'abcd',
        'thirdPartyName' => 'magento',
        'isProductSyncEnable' => true,
        'actions' => array(),
        'setting' => array(),
    );

    public function getEntity()
    {
        return new SubscriptionRequest();
    }
}
