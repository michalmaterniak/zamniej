<?php
namespace App\Services\Seo;

use App\Services\Seo\Methods\SeoMethod;
use Doctrine\Common\Collections\ArrayCollection;

abstract class SeoMethodsManager
{
    /**
     * @var ArrayCollection|SeoMethod[] $seoMethods
     */
    protected $seoMethods;

    public function __construct()
    {
        $this->seoMethods = new ArrayCollection();
    }

    /**
     * @param SeoMethod $method
     */
    public function register(SeoMethod $method)
    {
        $this->seoMethods->set($method->getName(), $method);
    }

    /**
     * @param string $name
     * @return SeoMethod|null
     */
    public function getMethod(string $name): ?SeoMethod
    {
        return $this->seoMethods->get($name);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function checkMethod(string $name): bool
    {
        return (bool)$this->seoMethods->get($name);
    }
}
