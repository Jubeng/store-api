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
     * @return void
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

            return $this->createSuccessMessage($mCreateProductResponse->toArray(), 200);

        } catch (ModelNotFoundException $oModelException) {
            Log::error('Error occurred while connecting to database: ' . $oModelException->getMessage());
            return $this->createErrorMessage('Error occurred while connecting to database. Please try again later.', 503);

        } catch (QueryException $oQueryException) {
            Log::error('Error occurred while executing the product query: ' . $oQueryException->getMessage());
            return $this->createErrorMessage('Error occurred while processing the product. Please try again later.', 422);
        }

    }
}