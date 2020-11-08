<?php
namespace App\Services\System\Request\Retrievers;

use App\Services\System\Request\Retrievers\Interfaces\RequestDataInterface;
use App\Services\System\Request\Retrievers\RequestData\RequestGetData;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use App\Services\System\Request\Retrievers\RequestData\RequestUriData;

class RequestDataManager implements RequestDataInterface
{
    /**
     * @var RequestData[] $registred
     */
    protected $registred;
    public function __construct(
        RequestGetData              $requestGetData,
        RequestPostContentData      $requestPostContentData,
        RequestUriData              $requestUriData
    ) {
        $this->registred[] = $requestPostContentData;
        $this->registred[] = $requestGetData;
        $this->registred[] = $requestUriData;
    }

    public function getValue(string $id, $defaultIfNotExistReturn = null)
    {
        foreach ($this->registred as $registerRequestData) {
            if ($registerRequestData->checkIfExist($id)) {
                return $registerRequestData->getValue($id);
            }
        }

        return $defaultIfNotExistReturn;
    }

    public function checkIfExist(string $id) : bool
    {
        foreach ($this->registred as $registerRequestData) {
            if ($registerRequestData->checkIfExist($id)) {
                return true;
            }
        }

        return false;
    }
}
