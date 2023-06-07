<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductQtyRequest;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * ProductController
 */
class ProductController extends Controller
{
    /**
     * oProductService
     *
     * @var ProductService
     */
    protected $oProductService;

    /**
     * __construct
     *
     * @param \App\Services\ProductService $oProductService
     */
    public function __construct(ProductService $oProductService)
    {
        $this->oProductService = $oProductService;
    }

    /**
     * Pass the product information to service to save to database
     *
     * @param CreateProductRequest $oRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function createProduct(CreateProductRequest $oRequest)
    {
        try {
            $mCreateProductResponse = $this->oProductService->createProduct($oRequest->all());
            return response()->json([$mCreateProductResponse], $mCreateProductResponse['code']);
        } catch (Exception $oException) {
            Log::error('Error occurred while creating product: ' . $oException->getMessage());
            return response()->json('Error occurred while creating product.', 400);
        }
    }

    /**
     * Pass the store_id to service to fetch all its products.
     *
     * @param \Illuminate\Http\Request $oRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProductsByStoreId(Request $oRequest)
    {
        try {
            $aValidatedParam = $oRequest->validate([
                'store_id' => 'required|numeric',
            ]);
            $mCreateProductResponse = $this->oProductService->getAllProductsByStoreId($aValidatedParam['store_id']);
            return response()->json([$mCreateProductResponse], $mCreateProductResponse['code']);
        } catch (Exception $oException) {
            Log::error('Error occurred while fetching products: ' . $oException->getMessage());

            if ($oException instanceof \Illuminate\Validation\ValidationException) {
                $aErrors = $oException->validator->errors()->all();
                return response()->json(
                    [
                        'errors' => $aErrors,
                        'code'   => 422
                    ],
                    422);
            }
            return response()->json('Error occurred while fetching products.', 400);
        }
    }

    /**
     * Pass the product_id and store_id to service to fetch the product's info.
     *
     * @param \Illuminate\Http\Request $oRequest
     * @param string $sProductId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductInfo(Request $oRequest, string $sProductId)
    {
        try {
            $oRequest->query->set('product_id', $sProductId);
            $aValidatedParam = $oRequest->validate([
                'store_id'   => 'required|integer',
                'product_id' => 'required|integer',
            ]);
            $mGetProductInfoResponse = $this->oProductService->getProductInfo($aValidatedParam);
            return response()->json([$mGetProductInfoResponse], $mGetProductInfoResponse['code']);
        } catch (Exception $oException) {
            Log::error('Error occurred while fetching product info: ' . $oException->getMessage());

            if ($oException instanceof \Illuminate\Validation\ValidationException) {
                $aErrors = $oException->validator->errors()->all();
                return response()->json(
                    [
                        'errors' => $aErrors,
                        'code'   => 422
                    ],
                    422);
            }
            return response()->json('Error occurred while fetching product information.', 400);
        }
    }

    /**
     * Pass the product information to service to update the Qty of a product.
     *
     * @param \Illuminate\Http\Request $oRequest
     * @param string $sProductId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProductQty(Request $oRequest, string $sProductId)
    {
        try {
            $oRequest->query->set('product_id', $sProductId);
            $aValidatedParam = $oRequest->validate([
                'store_id'           => 'required|integer',
                'product_id'         => 'required|integer',
                'inventory_quantity' => 'required|integer',
            ]);
            $mGetProductInfoResponse = $this->oProductService->updateProductQty($aValidatedParam);
            return response()->json([$mGetProductInfoResponse], $mGetProductInfoResponse['code']);
        } catch (Exception $oException) {
            Log::error('Error occurred while updated the product quantity: ' . $oException->getMessage());

            if ($oException instanceof \Illuminate\Validation\ValidationException) {
                $aErrors = $oException->validator->errors()->all();
                return response()->json(
                    [
                        'errors' => $aErrors,
                        'code'   => 422
                    ],
                    422);
            }
            return response()->json('Error occurred while updated the product quantity.', 400);
        }
    }
}