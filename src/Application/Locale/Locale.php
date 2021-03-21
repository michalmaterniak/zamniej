<?php
namespace App\Application\Locale;

use App\Services\System\Locale\Locale as GlobalLocale;
use App\Services\System\Request\Retrievers\RequestDataManager;
use Symfony\Component\HttpFoundation\RequestStack;

class Locale extends GlobalLocale
{
    public function __construct(string $defaultHttpAddress, string $defaultLocale, RequestDataManager $requestDataManager, RequestStack $requestStack)
    {
        parent::__construct($defaultHttpAddress, $defaultLocale, $requestDataManager, $requestStack);
    }
}
