<?php

namespace App\Application\Pages\Resource\Settings;

use App\Application\Pages\PagesManager;
use App\Entity\Entities\Settings\Settings;
use App\Repository\Repositories\Settings\SettingsRepository;
use App\Services\System\Settings\SettingsResource;
use Doctrine\Common\Collections\ArrayCollection;

class SettingsPage extends SettingsResource
{
    /**
     * @var ArrayCollection|Settings[] $settings
     */
    protected $settings;

    public function __construct(
        protected PagesManager $pagesManager,
        protected SettingsRepository $settingsRepository
    ) {
        parent::__construct(
            $this->pagesManager,
            $this->settingsRepository
        );
    }

}
