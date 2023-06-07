<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
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
     * Pass the product information to service
     *
     * @param CreateProductRequest $aRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function createProduct(CreateProductRequest $aRequest)
    {
        try {
            $mCreateProductResponse = $this->oProductService->createProduct($aRequest->all());
            return response()->json([$mCreateProductResponse], $mCreateProductResponse['code']);
        } catch (Exception $oException) {
            Log::error('Error occurred while creating product: ' . $oException->getMessage());
            return response()->json('Error occurred while creating product.', 400);
        }
    }

    /**
     * Undocumented function
     *
     * @param \Illuminate\Http\Request $aRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProductsByStoreId(Request $aRequest)
    {
        try {
            $aValidatedParam = $aRequest->validate([
                'store_id' => 'required|numeric', // Example validation rule
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
}