<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Services\StoreService;
use Exception;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    /**
     * oStoreService
     *
     * @var StoreService
     */
    protected $oStoreService;

    /**
     * __construct
     *
     * @param \App\Services\StoreService $oStoreService
     */
    public function __construct(StoreService $oStoreService)
    {
        $this->oStoreService = $oStoreService;
    }

    /**
     * Validates and pass the new store information to the service
     *
     * @param \App\Http\Requests\StoreRequest $oRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function addStore(StoreRequest $oRequest)
    {
        try {
            $mAddStoreResponse = $this->oStoreService->addStore($oRequest->all());
            return response()->json([$mAddStoreResponse], $mAddStoreResponse['code']);
        } catch (Exception $oException) {
            Log::error('Error occurred while adding store: ' . $oException->getMessage());
            return response()->json('Error occurred while adding store.', 400);
        }
    }
}