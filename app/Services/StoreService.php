<?php

namespace App\Services;

use App\Models\StoreModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

/**
 * StoreService
 */
class StoreService extends BaseService
{
    /**
     * Add the store information to database
     *
     * @param array $aStore
     * @return array
     */
    public function addStore(array $aStore)
    {
        try {
            $mAddStoreResponse = StoreModel::create([
                'name' => $aStore['name'],
                'url'  => $aStore['url'],
            ]);

            return $this->createSuccessMessage('The store is created successfully.', $mAddStoreResponse->toArray(), 200);

        } catch (ModelNotFoundException $oModelException) {
            return $this->createExceptionResponse([
                'sType'       => 'model',
                'oException'  => $oModelException,
            ]);

        } catch (QueryException $oQueryException) {
            Log::error('Error occurred while executing the store query: ' . $oQueryException->getMessage());
            if ($oQueryException->getCode() === '23000') {
                return $this->createErrorMessage('The URL should be unique, please input a new URL.', 422);
            }
            return $this->createErrorMessage('Error occurred while processing the store data. Please try again later.', 422);
        }

    }
}