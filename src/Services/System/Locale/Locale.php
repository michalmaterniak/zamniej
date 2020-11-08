<?php
namespace App\Services\System\Locale;

use App\Services\System\Locale\Interfaces\LocaleInterface;
use App\Services\System\Request\Retrievers\RequestDataManager;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class Locale implements LocaleInterface
{
    protected RequestStack          $requestStack;
    protected RequestDataManager    $requestDataManager;

    protected string                $locale;

    public function __construct(string $defaultLocale, RequestDataManager $requestDataManager, RequestStack $requestStack)
    {
        $this->requestStack =           $requestStack;
        $this->requestDataManager =     $requestDataManager;
        $this->locale =
            (string) $this->requestDataManager->getValue(
                'locale',
                $this->requestStack->getCurrentRequest() ?
                    $this->requestStack->getCurrentRequest()->getLocale():
                    $defaultLocale
            );
    }

    public function getLocale() : string
    {
        return $this->locale;
    }
    public function __toString() : string
    {
        return $this->getLocale();
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }
}
