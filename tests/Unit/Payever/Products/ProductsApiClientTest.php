<?php

namespace Payever\Tests\Unit\Payever\Products;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Payever\Sdk\Core\Authorization\OauthTokenList;
use Payever\Sdk\Core\Base\OauthTokenInterface;
use Payever\Sdk\Core\ClientConfiguration;
use Payever\Sdk\Core\Http\Client\CurlClient;
use Payever\Sdk\Core\Http\Response;
use Payever\Sdk\Products\Http\RequestEntity\ProductRemovedRequest;
use Payever\Sdk\Products\Http\RequestEntity\ProductRequest;
use Payever\Sdk\Products\ProductsApiClient;
use Psr\Log\NullLogger;

/**
 * Class ProductsApiClientTest
 *
 * @see \Payever\Sdk\Products\ProductsApiClient
 */
class ProductsApiClientTest extends TestCase
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
     * @var ProductsApiClient
     */
    private $productsApiClient;

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

        $this->productsApiClient = new ProductsApiClient(
            $this->clientConfiguration,
            $oauthTokenList,
            $this->httpClientMock
        );
    }

    public function testCreateProduct()
    {
        $request = new ProductRequest();
        $result = $this->productsApiClient->createProduct($request);
        $this->assertNotEmpty($result);
    }

    public function testUpdateProduct()
    {
        $request = new ProductRequest();
        $result = $this->productsApiClient->updateProduct($request);
        $this->assertNotEmpty($result);
    }

    public function testCreateOrUpdateProduct()
    {
        $request = new ProductRequest();
        $result = $this->productsApiClient->createOrUpdateProduct($request);
        $this->assertNotEmpty($result);
    }

    public function testRemoveProduct()
    {
        $request = new ProductRemovedRequest();
        $result = $this->productsApiClient->removeProduct($request);
        $this->assertNotEmpty($result);
    }
}
