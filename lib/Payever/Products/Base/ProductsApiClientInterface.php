<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Base
 * @package   Payever\Products
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Products\Base;

use Payever\Sdk\Core\Http\Response;
use Payever\Sdk\Products\Http\RequestEntity\ProductCollectionRequest;
use Payever\Sdk\Products\Http\RequestEntity\ProductRemovedRequest;
use Payever\Sdk\Products\Http\RequestEntity\ProductRequest;

/**
 * Interface describes functions of ProductsApiClient
 */
interface ProductsApiClientInterface
{
    /**
     * Inform payever about product created
     *
     * @param ProductRequest $productRequest
     *
     * @return mixed
     */
    public function createProduct(ProductRequest $productRequest);

    /**
     * Inform payever about product updated
     *
     * @param ProductRequest $productRequest
     *
     * @return Response
     */
    public function updateProduct(ProductRequest $productRequest);

    /**
     * @param ProductRequest $productRequest
     *
     * @return Response
     */
    public function createOrUpdateProduct(ProductRequest $productRequest);

    /**
     * Inform payever about product collection create/updated
     *
     * @param ProductCollectionRequest $productRequest
     *
     * @return Response
     */
    public function createOrUpdateProductCollection(ProductCollectionRequest $productRequest);

    /**
     * Inform payever about product being removed
     *
     * @param ProductRemovedRequest $productRequest
     *
     * @return Response
     */
    public function removeProduct(ProductRemovedRequest $productRequest);

    /**
     * Batch export products to payever
     *
     * @param ProductsIteratorInterface $productsIterator
     * @param string                    $externalId
     *
     * @return int - Number of successfully exported records
     */
    public function exportProducts(ProductsIteratorInterface $productsIterator, $externalId);
}
