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

    public function __construct(
        SettingsRepository      $settingsRepository,
        SeoTitle                $seoTitle,
        SeoHeader               $seoHeader,
        SeoDescription          $seoDescription,
        SeoCanonical            $seoCanonical
    ) {
        $this->settingsRepository =     $settingsRepository;
        $this->seoTitle =               $seoTitle;
        $this->seoHeader =              $seoHeader;
        $this->seoDescription =         $seoDescription;
        $this->seoCanonical =           $seoCanonical;
    }

    public function getNameSetting()
    {
        return 'Seo-'.$this->resource->getComponents()->getResourceConfig()->getTypeName();
    }
    public function loadResource(Resource $resource)
    {
        if (!$this->resource || $this->resource->getModelEntity()->getIdResource() != $resource->getModelEntity()->getIdResource()) {
            $this->resource = $resource;
            if (!$this->settings) {
                $this->settings = $this->settingsRepository->select()->getOneById($this->getNameSetting())->getResultOrNull();
            }
        }
    }

    public function checkAvailableProperty(string $key) : bool
    {
        return (bool) $this->getAvailableProperty($key);
    }

    abstract public function getAvailableProperties() : array;

    public function getAvailableProperty(string $key) : ?string
    {
        return static::getAvailableProperties()[$key] ?? null;
    }
    /**
     * @return Resource
     */
    public function getResource(): Resource
    {
        return $this->resource;
    }

    public function getTitle()
    {
        return
            $this->getResource()->getSubpage()->getSubpage()->getSeo()->getTitle() ?:
            $this->seoTitle->getTitle($this, $this->settings[self::TITLE] ?? 'title empty');
    }

    public function getHeader()
    {
        return
            $this->getResource()->getSubpage()->getSubpage()->getSeo()->getHeader() ?:
            $this->seoHeader->getHeader($this, $this->settings[self::HEADER] ?? 'header empty');
    }
    public function getDescription()
    {
        return
            $this->getResource()->getSubpage()->getSubpage()->getSeo()->getDescription() ?:
            $this->seoDescription->getDescription($this, $this->settings[self::DESCRIPTION] ?? 'description empty');
    }

    public function getCanonical()
    {
        return
            $this->getResource()->getSubpage()->getSubpage()->getSeo()->getCanonical() ?:
            $this->seoCanonical->getCanonical($this->resource);
    }
}
