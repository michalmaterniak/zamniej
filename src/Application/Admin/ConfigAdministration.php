<?php
namespace App\Application\Admin;

use App\Application\Admin\ConfigAdmin\FindNewPrograms;
use App\Services\Admin\ConfigAdministration as GlobalConfigAdministration;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ConfigAdministration extends GlobalConfigAdministration
{
    /**
     * @var FindNewPrograms $findNewPrograms
     */
    protected $findNewPrograms;
    public function __construct(
        ParameterBagInterface $parameterBag,
        FindNewPrograms $findNewPrograms
    ) {
        parent::__construct($parameterBag);
        $this->findNewPrograms = $findNewPrograms;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig()
    {
        $this->setBaseConfig();
        $this->config->set('select_language_disabled', true);
        $this->config->set('countNewPrograms', $this->findNewPrograms->getNewProgramsAffiliations());
    }
}
