<?php

namespace Payever\Tests\Unit\Payever\ThirdParty;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Payever\Sdk\Core\Authorization\OauthTokenList;
use Payever\Sdk\Core\Base\OauthTokenInterface;
use Payever\Sdk\Core\ClientConfiguration;
use Payever\Sdk\Core\Http\Client\CurlClient;
use Payever\Sdk\Core\Http\Response;
use Payever\Sdk\ThirdParty\Http\RequestEntity\SubscriptionRequest;
use Payever\Sdk\ThirdParty\ThirdPartyApiClient;
use Psr\Log\NullLogger;

/**
 * Class ThirdPartyApiClientTest
 *
 * @see \Payever\Sdk\ThirdParty\ThirdPartyApiClient
 */
class ThirdPartyApiClientTest extends TestCase
{
    /**
     * @var (ClientConfiguration&MockObject)|\PHPUnit_Framework_MockObject_MockObject
     */
    private $clientConfiguration;

    /**
     * @var (CurlClient&MockObject)|\PHPUnit_Framework_MockObject_MockObject
     */
    private $httpClientMock;

    /**
     * @var ThirdPartyApiClient
     */
    private $thirdPartyApiClient;

    protected function setUp()
    {
        $this->clientConfiguration = $this->getMockBuilder(ClientConfiguration::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientConfiguration->expects($this->any())
            ->method('getLogger')
            ->willReturn(new NullLogger());

        $this->clientConfiguration->expects($this->once())
            ->method('assertLoaded');

        $this->httpClientMock = $this->getMockBuilder(CurlClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->httpClientMock->expects($this->once())
            ->method('execute')
            ->willReturn(
                $this->getMockBuilder(Response::class)
                    ->disableOriginalConstructor()
                    ->getMock()
            );

        $oauthTokenList = $this->getMockBuilder(OauthTokenList::class)
            ->disableOriginalConstructor()
            ->getMock();

        $oauthTokenList->expects($this->once())
            ->method('load')
            ->willReturn(
                $tokenList = $this->getMockBuilder(OauthTokenList::class)
                    ->disableOriginalConstructor()
                    ->getMock()
            );

        $tokenList->expects($this->once())
            ->method('get')
            ->willReturn(
                $token = $this->getMockBuilder(OauthTokenInterface::class)
                    ->disableOriginalConstructor()
                    ->getMock()
            );

        $token->expects($this->once())
            ->method('getParams')
            ->willReturn(['some-params']);

        $token->expects($this->once())
            ->method('getAuthorizationString')
            ->willReturn('some-authorization-string');

        $this->thirdPartyApiClient = new ThirdPartyApiClient(
            $this->clientConfiguration,
            $oauthTokenList,
            $this->httpClientMock
        );
    }

    public function testGetBusinessRequest()
    {
        $result = $this->thirdPartyApiClient->getBusinessRequest();
        $this->assertNotEmpty($result);
    }

    public function testGetSubscriptionStatus()
    {
        $request = new SubscriptionRequest();
        $result = $this->thirdPartyApiClient->getSubscriptionStatus($request);
        $this->assertNotEmpty($result);
    }

    public function testSubscribe()
    {
        $request = new SubscriptionRequest();
        $result = $this->thirdPartyApiClient->subscribe($request);
        $this->assertNotEmpty($result);
    }

    public function testUnsubscribe()
    {
        $request = new SubscriptionRequest();
        $result = $this->thirdPartyApiClient->unsubscribe($request);
        $this->assertNotEmpty($result);
    }
}
