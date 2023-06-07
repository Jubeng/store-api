<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Services\ProductService;
use Exception;
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
     * Undocumented function
     *
     * @param \App\Http\Requests\CreateProductRequest $aRequest
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

    public function getAllProducts(CreateProductRequest $aRequest)
    {
        dd($aRequest->all());
    }
}