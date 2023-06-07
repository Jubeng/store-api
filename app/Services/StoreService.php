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
     * @return mixed
     */
    public function addStore(array $aStore)
    {
        try {
            $mAddStoreResponse = StoreModel::create([
                'name' => $aStore['name'],
                'url'  => $aStore['url'],
            ]);

            return $this->createSuccessMessage($mAddStoreResponse->toArray(), 200);

        } catch (ModelNotFoundException $oModelException) {
            Log::error('Error occurred while connecting to database: ' . $oModelException->getMessage());
            return $this->createErrorMessage('Error occurred while connecting to database. Please try again later.', 503);

        } catch (QueryException $oQueryException) {
            Log::error('Error occurred while executing the query: ' . $oQueryException->getMessage());
            if ($oQueryException->getCode() === '23000') {
                return $this->createErrorMessage('The URL should be unique, please input a new URL.', 422);
            }
            return $this->createErrorMessage('Error occurred while processing the data. Please try again later.', 422);
        }

    }
}