<?php
namespace App\Services\System\Locale;

use App\Services\System\Locale\Interfaces\LocaleInterface;
use App\Services\System\Request\Retrievers\RequestDataManager;

abstract class Locale implements LocaleInterface
{
    protected string $locale;

    /**
     * @var string $address
     */
    protected $address;

    public function __construct(string $defaultHttpAddress, string $defaultLocale, RequestDataManager $requestDataManager)
    {
        $this->locale =
            (string)$requestDataManager->getValue(
                'locale',
                $defaultLocale
            );

        $this->address = $defaultHttpAddress;
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

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }
}
