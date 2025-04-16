<?php

namespace Payever\Tests\Unit\Payever\ThirdParty\Http\ResponseEntity;

use Payever\Sdk\ThirdParty\Http\ResponseEntity\BusinessResponse;
use Payever\Tests\Unit\Payever\Core\Http\AbstractMessageEntityTest;

class BusinessResponseTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'name' => 'stub',
        'currency' => 'EUR',
        'subscriptions' => array()
    );

    public static function getScheme()
    {
        $scheme = parent::getScheme();
        $scheme['subscriptions'][] = SubscriptionResponseTest::getScheme();

        return $scheme;
    }

    public function getEntity()
    {
        return new BusinessResponse();
    }
}
