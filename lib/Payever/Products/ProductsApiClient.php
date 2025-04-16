<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Products
 * @package   Payever\Products
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Products;

use Payever\Sdk\Core\Http\RequestBuilder;
use Payever\Sdk\Core\Http\ResponseEntity\DynamicResponse;
use Payever\Sdk\Products\Base\ProductsApiClientInterface;
use Payever\Sdk\Products\Base\ProductsIteratorInterface;
use Payever\Sdk\Products\Http\RequestEntity\ProductCollectionRequest;
use Payever\Sdk\Products\Http\RequestEntity\ProductRemovedRequest;
use Payever\Sdk\Products\Http\RequestEntity\ProductRequest;
use Payever\Sdk\ThirdParty\CommonProductsThirdPartyApiClient;

/**
 * This class represents payever Products API Connector
 * ProductsApiClient manages product operations like creating, updating, removing, and exporting products via the API
 */
class ProductsApiClient extends CommonProductsThirdPartyApiClient implements ProductsApiClientInterface
{
    const SUB_URL_PRODUCT = 'api/product/%s';

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function createProduct(ProductRequest $productRequest)
    {
        $this->getConfiguration()->assertLoaded();
        $url = $this->getProductUrl($productRequest->getExternalId());

        $request = RequestBuilder::post($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($productRequest)
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function updateProduct(ProductRequest $productRequest)
    {
        $this->getConfiguration()->assertLoaded();
        $url = $this->getProductUrl($productRequest->getExternalId());

        $request = RequestBuilder::patch($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($productRequest)
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function createOrUpdateProduct(ProductRequest $productRequest)
    {
        $this->getConfiguration()->assertLoaded();
        $url = $this->getProductUrl($productRequest->getExternalId());

        $products = new ProductCollectionRequest();
        $products->setExternalId($productRequest->getExternalId());
        $products->addProduct($productRequest);

        $request = RequestBuilder::put($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($products)
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function createOrUpdateProductCollection(ProductCollectionRequest $productRequest)
    {
        $this->getConfiguration()->assertLoaded();
        $url = $this->getProductUrl($productRequest->getExternalId());

        $request = RequestBuilder::put($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($productRequest)
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function removeProduct(ProductRemovedRequest $productRequest)
    {
        $this->getConfiguration()->assertLoaded();
        $url = $this->getProductUrl($productRequest->getExternalId());

        $request = RequestBuilder::delete($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($productRequest)
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function exportProducts(ProductsIteratorInterface $productsIterator, $externalId)
    {
        $this->getConfiguration()->assertLoaded();
        $successCount = 0;

        $productCollection = new ProductCollectionRequest();
        $productCollection->setExternalId($externalId);

        foreach ($productsIterator as $productRequestEntity) {
            $productRequestEntity->setExternalId($externalId);
            $productCollection->addProduct($productRequestEntity);
            $successCount++;
        }

        $this->createOrUpdateProductCollection($productCollection);

        return $successCount;
    }

    /**
     * @param string $externalId
     *
     * @return string
     */
    protected function getProductUrl($externalId)
    {
        return $this->getBaseUrl() . sprintf(static::SUB_URL_PRODUCT, $externalId);
    }
}
