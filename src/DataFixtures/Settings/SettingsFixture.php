<?php
namespace App\DataFixtures\Settings;

use App\DataFixtures\Fixtures;
use App\Entity\Entities\Settings\Settings;
use App\Services\Seo\SeoElements;

class SettingsFixture extends Fixtures
{
    public function createSeoSetting(string $name)
    {
        $setting = new Settings();
        $setting->setIdSetting('Seo-'.$name);
        $setting[SeoElements::TITLE] =          '{{name}} - '.$name.' title';
        $setting[SeoElements::HEADER] =         '{{name}} - '.$name.' header';
        $setting[SeoElements::DESCRIPTION] =    '{{name}} - '.$name.' desc';
        $this->entityManager->persist($setting);
        $this->entityManager->flush();
    }

    public function createSeoShopsShop()
    {
        $setting = new Settings();
        $setting->setIdSetting('Seo-Shops-Shop');
        $setting[SeoElements::TITLE] =          "{{name}} - aktualne promocje, wyprzedaże i najnowsze kupony rabatowe * Wrzesień 2020 *";
        $setting[SeoElements::HEADER] =         "Aktualne promocje, wyprzedaże i kupony rabatowe - {{name}} * Wrzesień 2020 *";
        $setting[SeoElements::DESCRIPTION] =    "{{name}} - zawsze aktualne promocje, wyprzedaże i najnowsze kupony rabatowe * Wrzesień 2020 *";
        $this->entityManager->persist($setting);
        $this->entityManager->flush();
    }
    protected function createPopularShops()
    {
        $setting = new Settings();
        $setting->setIdSetting('Popular-Shops');
        $setting['Popular-Shops'] = [53, 54, 55];
        $this->entityManager->persist($setting);
        $this->entityManager->flush();
    }
    public function load()
    {
        $this->createSeoShopsShop();
        $this->createPopularShops();
    }
}
