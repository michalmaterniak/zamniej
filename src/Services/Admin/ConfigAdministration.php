<?php
namespace App\Services\Admin;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

abstract class ConfigAdministration
{
    /**
     * @var ParameterBagInterface $parametersBag
     */
    protected $parametersBag;
    /**
     * @var ArrayCollection $config
     */
    protected $config;
    public function __construct(ParameterBagInterface  $parameterBag)
    {
        $this->parametersBag = $parameterBag;
    }

    protected function setBaseConfig()
    {
        $this->config = new ArrayCollection(
            [
                'langs' => $this->parametersBag->get('locales'),
                'currentLocale' => $this->parametersBag->get('defaultLocale'),
                'filePath' => $this->parametersBag->get('filePath'),
            ]
        );
    }
}
