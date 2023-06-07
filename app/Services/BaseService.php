<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

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
     * @param string $sMessage
     * @param array $aData
     * @param integer $iStatusCode
     * @return array
     */
    protected function createSuccessMessage(string $sMessage, array $aData, int $iStatusCode)
    {
        return [
            'message' => $sMessage,
            'data'    => $aData,
            'code'    => $iStatusCode
        ];
    }

    /**
     * Creates a timestamp of the current server time.
     *
     * @return string
     */
    protected function createTimestamp()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * Creates an error Log and response when Exception is caught.
     *
     * @param array $aParam
     * @return array
     */
    protected function createExceptionResponse(array $aParam)
    {
        $sMessage = 'Error occurred while connecting to database';
        $iStatusCode = 503;
        if ($aParam['sType'] === 'query') {
            $sMessage = $aParam['sMessage'];
            $iStatusCode = 422;
        }
        Log::error($sMessage . ': ' . $aParam['oException']->getMessage());
        return $this->createErrorMessage($sMessage . '. Please try again later.', $iStatusCode);
    }
}