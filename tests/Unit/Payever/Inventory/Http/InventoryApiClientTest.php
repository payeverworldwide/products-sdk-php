<?php

namespace Payever\Tests\Unit\Payever\Inventory\Http;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Payever\Sdk\Core\Authorization\OauthTokenList;
use Payever\Sdk\Core\Base\OauthTokenInterface;
use Payever\Sdk\Core\ClientConfiguration;
use Payever\Sdk\Core\Http\Client\CurlClient;
use Payever\Sdk\Core\Http\Response;
use Payever\Sdk\Inventory\Http\RequestEntity\InventoryChangedRequest;
use Payever\Sdk\Inventory\Http\RequestEntity\InventoryCreateRequest;
use Payever\Sdk\Inventory\InventoryApiClient;
use Psr\Log\NullLogger;

/**
 * Class InventoryApiClientTest
 *
 * @see \Payever\Sdk\Inventory\InventoryApiClient
 */
class InventoryApiClientTest extends TestCase
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
     * @var InventoryApiClient
     */
    private $inventoryApiClient;

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

        $this->inventoryApiClient = new InventoryApiClient(
            $this->clientConfiguration,
            $oauthTokenList,
            $this->httpClientMock
        );
    }

    public function testCreateInventory()
    {
        $request = new InventoryCreateRequest();
        $result = $this->inventoryApiClient->createInventory($request);
        $this->assertNotEmpty($result);
    }

    public function testAddInventory()
    {
        $request = new InventoryChangedRequest();
        $result = $this->inventoryApiClient->addInventory($request);
        $this->assertNotEmpty($result);
    }

    public function testSubtractInventory()
    {
        $request = new InventoryChangedRequest();
        $result = $this->inventoryApiClient->subtractInventory($request);
        $this->assertNotEmpty($result);
    }
}
