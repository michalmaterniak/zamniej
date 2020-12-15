<?php
namespace App\Application\Pages\Page\Types\Shops\Services;

use App\Services\System\Request\Retrievers\RequestDataManager;

class CheckerLetter
{
    /**
     * @var mixed|null $letter
     */
    protected $letter;

    /**
     * @var RequestDataManager $requestDataManager
     */
    protected $requestDataManager;

    public function __construct(RequestDataManager $requestDataManager)
    {
        $this->requestDataManager = $requestDataManager;
        $this->letter = $requestDataManager->getValue('letter', null);
    }

    public function checkLetter()
    {
        return $this->letterExist()
            && strlen($this->letter) === 1
            && preg_match_all('/^([a-z]|[A-Z]|[0-9])$/', $this->letter, $matches);
    }

    public function letterExist()
    {
        return $this->requestDataManager->checkIfExist('letter');
    }
}
