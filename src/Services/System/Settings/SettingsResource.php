<?php

namespace App\Services\System\Settings;

use App\Entity\Entities\Settings\Settings;
use App\Repository\Repositories\Settings\SettingsRepository;
use App\Services\Pages\ResourcesManager;
use Doctrine\Common\Collections\ArrayCollection;

abstract class SettingsResource
{
    /**
     * @var ArrayCollection|Settings[] $settings
     */
    protected $settings;

    public function __construct(
        protected ResourcesManager $resourcesManager,
        protected SettingsRepository $settingsRepository
    ) {}

    public function getSettings()
    {
        if (!$this->settings) {
            $this->settings = $this->settingsRepository->select()->getByTargetOrNull(
                $this->resourcesManager->getCurrentResourceModel()->getComponents()->getResourceConfig()->getTypeName()
            )->getResults();
        }

        return $this->settings;
    }
}
