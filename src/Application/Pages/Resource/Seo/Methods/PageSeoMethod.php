<?php

namespace App\Application\Pages\Resource\Seo\Methods;

use App\Services\Seo\Methods\SeoMethod;
use App\Services\System\Request\Retrievers\RequestDataManager;

/**
 * Class PageSeoMethod
 * @package App\Application\Pages\Resource\Seo\Methods
 */
class PageSeoMethod extends SeoMethod
{
    /**
     * @var string $name
     */
    protected $name = 'page';
    /**
     * @var RequestDataManager $requestData
     */
    protected $requestData;

    /**
     * PageSeoMethod constructor.
     * @param RequestDataManager $requestData
     */
    public function __construct(RequestDataManager $requestData)
    {
        $this->requestData = $requestData;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param null $value
     * @return string
     */
    public function getValue($value = null): string
    {
        if ($this->requestData->checkIfExist($this->name)) {
            return 'Strona nr. ' . $this->requestData->getValue($this->name);
        }
        return '';
    }
}
