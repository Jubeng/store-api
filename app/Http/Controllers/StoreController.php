<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Services\StoreService;
use Illuminate\Http\Request;

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


    public function addStore(StoreRequest $aRequest)
    {
        dd($aRequest->all());
    }
}