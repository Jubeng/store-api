<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

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

    public function createProduct(Request $aRequest)
    {
        dd($aRequest->all());
    }

    public function getAllProducts(Request $aRequest)
    {
        dd($aRequest->all());
    }
}