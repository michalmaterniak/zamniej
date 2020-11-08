<?php
namespace App\Services\System\Request\Retrievers;

use App\Services\System\Request\Retrievers\Interfaces\RequestDataInterface;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class RequestData implements RequestDataInterface
{
    /**
     * @var RequestStack $requestStack
     */
    protected $requestStack;

    /**
     * @var array $vars
     */
    protected $vars;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->setData();
    }

    abstract protected function setData();

    public function getValue(string $id, $defaultIfNotExistReturn = null)
    {
        return $this->vars[$id] ?? $defaultIfNotExistReturn;
    }
    public function checkIfExist(string $id) : bool
    {
        return isset($this->vars[$id]) || array_key_exists($id, $this->vars);
    }

    /**
     * @return array
     */
    public function getVars(): array
    {
        return $this->vars;
    }
}
