<?php

namespace App\Services;

use App\Models\ProductModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

/**
 * BaseService
 */
class ProductService extends BaseService
{
    /**
     * Creates product under the respective store
     *
     * @param array $aProductInfo
     * @return array
     */
    public function createProduct(array $aProductInfo)
    {
        try {
            $mCreateProductResponse = ProductModel::create([
                'sku'                    => $aProductInfo['sku'],
                'name'                   => $aProductInfo['name'],
                'store_id'               => $aProductInfo['store_id'],
                'inventory_quantity'     => $aProductInfo['inventory_quantity'],
                'inventory_updated_time' => $this->createTimestamp(),
            ]);

            return $this->createSuccessMessage('The store is created successfully.', $mCreateProductResponse->toArray(), 200);

        } catch (ModelNotFoundException $oModelException) {
            return $this->createExceptionResponse([
                'sType'       => 'model',
                'oException'  => $oModelException,
            ]);

        } catch (QueryException $oQueryException) {
            Log::error('Error occurred while executing the create product query: ' . $oQueryException->getMessage());
            if ($oQueryException->getCode() === '23000') {
                return $this->createErrorMessage('The store id is not valid, please input a valid store id.', 422);
            }
            return $this->createErrorMessage('Error occurred while processing the product. Please try again later.', 422);
        }
    }

    /**
     * Fetch the products associated with the given store id.
     *
     * @param string $sStoreId
     * @return array
     */
    public function getAllProductsByStoreId(string $sStoreId)
    {
        try {
            $mGetProductsResponse = ProductModel::where('store_id', '=', $sStoreId)->get();
            $sMessage = 'The product(s) fetched successfully.';
            $aProducts = $mGetProductsResponse->toArray();
            if (count($aProducts) < 1) {
                $sMessage = 'No products found.';
            }
            return $this->createSuccessMessage($sMessage, $aProducts, 200);

        } catch (ModelNotFoundException $oModelException) {
            return $this->createExceptionResponse([
                'sType'       => 'model',
                'oException'  => $oModelException,
            ]);

        } catch (QueryException $oQueryException) {
            return $this->createExceptionResponse([
                'sType'       => 'query',
                'sMessage'    => 'Error occurred while fetching the product(s)',
                'oException'  => $oQueryException,
            ]);
        }
    }

    /**
     * Fetch a product's information using the product id and store id
     * from database.
     *
     * @param array $aParam
     * @return array
     */
    public function getProductInfo(array $aParam)
    {
        try {
            $mGetProductInfoResponse = ProductModel::where([
                ['store_id', '=', $aParam['store_id']],
                ['product_id', '=', $aParam['product_id']]
            ])->get();
            $sMessage = 'The product information is fetched successfully.';
            $aProducts = $mGetProductInfoResponse->toArray();
            if (count($aProducts) < 1) {
                $sMessage = 'No product found.';
            }
            return $this->createSuccessMessage($sMessage, $aProducts, 200);

        } catch (ModelNotFoundException $oModelException) {
            return $this->createExceptionResponse([
                'sType'       => 'model',
                'oException'  => $oModelException,
            ]);

        } catch (QueryException $oQueryException) {
            return $this->createExceptionResponse([
                'sType'       => 'query',
                'sMessage'    => 'Error occurred while fetching the product info',
                'oException'  => $oQueryException,
            ]);
        }
    }

    /**
     * Updates the Qty of the given product.
     *
     * @param array $aProductInfo
     * @return array
     */
    public function updateProductQty(array $aProductInfo)
    {
        try {
            $mUpdateProductQtyResponse = ProductModel::where([
                ['store_id', '=', $aProductInfo['store_id']],
                ['product_id', '=', $aProductInfo['product_id']]
            ])->update([
                'inventory_quantity' => $aProductInfo['inventory_quantity']
            ]);
            $sMessage = 'The product quantity is updated successfully.';
            if ($mUpdateProductQtyResponse < 1) {
                $sMessage = 'No product found or the input qty. is the same as before, please check your input.';
            }
            return $this->createSuccessMessage($sMessage, $aProductInfo, 200);

        } catch (ModelNotFoundException $oModelException) {
            return $this->createExceptionResponse([
                'sType'       => 'model',
                'oException'  => $oModelException,
            ]);

        } catch (QueryException $oQueryException) {
            return $this->createExceptionResponse([
                'sType'       => 'query',
                'sMessage'    => 'Error occurred while updating the product qty',
                'oException'  => $oQueryException,
            ]);
        }
    }
}