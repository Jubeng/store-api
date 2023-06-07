<?php

namespace App\Services;

/**
 * BaseService
 */
class BaseService
{  
    /**
     * Create an array for error message
     *
     * @param string $sMessage
     * @param integer $iStatusCode
     * @return array
     */
    protected function createErrorMessage(string $sMessage, int $iStatusCode)
    {
        return [
            'errors' => [
                'message' => $sMessage
            ],
            'code' => $iStatusCode
        ];
    }

    /**
     * Create an array for success message
     *
     * @param array $aData
     * @param integer $iStatusCode
     * @return array
     */
    protected function createSuccessMessage(array $aData, int $iStatusCode)
    {
        return [
            'message' => 'The store is created successfully.',
            'data'    => $aData,
            'code'    => $iStatusCode
        ];
    }
}