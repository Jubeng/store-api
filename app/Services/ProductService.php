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
            Log::error('Error occurred while connecting to database: ' . $oModelException->getMessage());
            return $this->createErrorMessage('Error occurred while connecting to database. Please try again later.', 503);

        } catch (QueryException $oQueryException) {
            Log::error('Error occurred while executing the create product query: ' . $oQueryException->getMessage());
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
            Log::error('Error occurred while connecting to database: ' . $oModelException->getMessage());
            return $this->createErrorMessage('Error occurred while connecting to database. Please try again later.', 503);

        } catch (QueryException $oQueryException) {
            Log::error('Error occurred while executing the fetch product query: ' . $oQueryException->getMessage());
            return $this->createErrorMessage('Error occurred while fetching the product(s). Please try again later.', 422);
        }
    }
}