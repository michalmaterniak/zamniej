<?php
namespace App\Services\Seo;

use App\Repository\Repositories\Settings\SettingsRepository;
use App\Services\Pages\Resource\Resource as Resource;
use App\Services\Seo\Interfaces\SeoInterface;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class Seo implements SeoInterface
{
    /**
     * @var SeoElements $seoElements
     */
    protected $seoElements;

    /**
     * @var SettingsRepository $settingsRepository
     */
    protected $settingsRepository;

    /**
     * @var SeoMethodsManager $seoMethods
     */
    protected $seoMethods;

    /**
     * Seo constructor.
     * @param SeoElements $seoElements
     * @param SettingsRepository $settingsRepository
     * @param SeoMethodsManager $seoMethods
     */
    public function __construct(
        SeoElements $seoElements,
        SettingsRepository $settingsRepository,
        SeoMethodsManager $seoMethods
    )
    {
        $this->seoElements = $seoElements;
        $this->seoMethods = $seoMethods;
        $this->settingsRepository = $settingsRepository;
    }

    public function loadResource(Resource $resource)
    {
        $this->seoElements->load($resource, $this->settingsRepository, $this->seoMethods);
    }

    /**
     * @return string
     * @Groups({"seo", "resource-admin"})
     */
    public function getTitle() : string
    {
        return $this->seoElements->getTitle();
    }

    /**
     * @return string
     * @Groups({"seo", "resource-admin"})
     */
    public function getHeader() : string
    {
        return $this->seoElements->getHeader();
    }

    /**
     * @return string
     * @Groups({"seo", "resource-admin"})
     */
    public function getDescription() : string
    {
        return $this->seoElements->getDescription();
    }

    /**
     * @return string
     * @Groups({"seo", "resource-admin"})
     */
    public function getCanonical() : ?string
    {
        return $this->seoElements->getCanonical();
    }
}
