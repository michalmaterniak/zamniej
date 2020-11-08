<?php
namespace App\DataFixtures\Pages;

use App\Application\Pages\PagesManager;
use App\DataFixtures\Fixtures;
use App\DataFixtures\Settings\SettingsFixture;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractPageFixtures extends Fixtures
{
    /**
     * @var SettingsFixture $settingsFixutres
     */
    protected $settingsFixutres;

    /**
     * @var PagesManager $modelPagesManager
     */
    protected $modelPagesManager;

    public function __construct(
        EntityManagerInterface      $entityManager,
        SettingsFixture             $settingsFixture,
        PagesManager           $modelPagesManager
    ) {
        parent::__construct($entityManager);
        $this->modelPagesManager =      $modelPagesManager;
        $this->settingsFixutres =       $settingsFixture;
    }
}
