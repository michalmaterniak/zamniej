<?php
namespace App\Services\Seo;

use App\Repository\Repositories\Settings\SettingsRepository;
use App\Services\Pages\Resource\Resource;
use App\Services\Seo\Elements\SeoCanonical;
use App\Services\Seo\Elements\SeoDescription;
use App\Services\Seo\Elements\SeoHeader;
use App\Services\Seo\Elements\SeoTitle;

abstract class SeoElements
{
    public const TITLE =         'title';
    public const HEADER =        'header';
    public const DESCRIPTION =   'description';

    /**
     * @var SettingsRepository $settingsRepository
     */
    protected $settingsRepository;
    /**
     * @var Resource $resource
     */
    protected $resource;

    /**
     * @var SeoMethodsManager $seoMethods
     */
    protected $seoMethods;

    /**
     * @var array|string[] $settings
     */
    protected $settings;

    /**
     * @var SeoTitle $seoTitle
     */
    protected $seoTitle;

    /**
     * @var SeoHeader $seoHeader
     */
    protected $seoHeader;

    /**
     * @var SeoDescription $seoDescription
     */
    protected $seoDescription;

    /**
     * @var SeoCanonical $seoCanonical
     */
    protected $seoCanonical;

    /**
     * SeoElements constructor.
     * @param SeoTitle $seoTitle
     * @param SeoHeader $seoHeader
     * @param SeoDescription $seoDescription
     * @param SeoCanonical $seoCanonical
     */
    public function __construct(
        SeoTitle $seoTitle,
        SeoHeader $seoHeader,
        SeoDescription $seoDescription,
        SeoCanonical $seoCanonical
    )
    {
        $this->seoTitle = $seoTitle;
        $this->seoHeader = $seoHeader;
        $this->seoDescription = $seoDescription;
        $this->seoCanonical = $seoCanonical;
    }

    /**
     * @return string
     */
    public function getNameSetting()
    {
        return 'Seo-' . $this->resource->getComponents()->getResourceConfig()->getTypeName();
    }

    /**
     * @param Resource $resource
     * @param SettingsRepository $settingsRepository
     * @param SeoMethodsManager $seoMethods
     */
    public function load(
        Resource $resource,
        SettingsRepository $settingsRepository,
        SeoMethodsManager $seoMethods
    )
    {
        $this->seoMethods = $seoMethods;
        $this->settingsRepository = $settingsRepository;
        if (!$this->resource || $this->resource->getModelEntity()->getIdResource() != $resource->getModelEntity()->getIdResource()) {
            $this->resource = $resource;
            if (!$this->settings) {
                $this->settings = $this->settingsRepository->select()->getOneById($this->getNameSetting())->getResultOrNull();
            }
        }
    }

    /**
     * @param string $key
     * @return bool
     */
    public function checkAvailableProperty(string $key): bool
    {
        return (bool)$this->getAvailableProperty($key);
    }


    /**
     * @return array
     */
    abstract public function getAvailableProperties(): array;

    /**
     * @param string $key
     * @return string|null
     */
    public function getAvailableProperty(string $key): ?string
    {
        return $this->getAvailableProperties()[$key] ?? null;
    }

    /**
     * @return Resource
     */
    public function getResource(): Resource
    {
        return $this->resource;
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return
            $this->getResource()->getSubpage()->getSubpage()->getSeo()->getTitle() ?:
                $this->seoTitle->getTitle($this, $this->settings[self::TITLE] ?? 'title empty');
    }

    /**
     * @return string|null
     */
    public function getHeader()
    {
        return
            $this->getResource()->getSubpage()->getSubpage()->getSeo()->getHeader() ?:
                $this->seoHeader->getHeader($this, $this->settings[self::HEADER] ?? 'header empty');
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return
            $this->getResource()->getSubpage()->getSubpage()->getSeo()->getDescription() ?:
                $this->seoDescription->getDescription($this, $this->settings[self::DESCRIPTION] ?? 'description empty');
    }

    /**
     * @return string|null
     */
    public function getCanonical()
    {
        return
            $this->getResource()->getSubpage()->getSubpage()->getSeo()->getCanonical() ?:
                $this->seoCanonical->getCanonical($this->resource);
    }

    /**
     * @return SeoMethodsManager
     */
    public function getSeoMethods(): SeoMethodsManager
    {
        return $this->seoMethods;
    }
}
