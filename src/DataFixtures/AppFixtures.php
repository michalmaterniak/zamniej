<?php
namespace App\DataFixtures;

use App\DataFixtures\Affiliations\AffiliationsFixtures;
use App\DataFixtures\Pages\BlogFixtures;
use App\DataFixtures\Pages\CategoriesFixtures;
use App\DataFixtures\Pages\HomepageFixtures;
use App\DataFixtures\Pages\PageFixtures;
use App\DataFixtures\Settings\SettingsFixture;
use App\DataFixtures\ShopTags\TagsFixture;
use App\DataFixtures\Sliders\SlidersFixture;
use App\DataFixtures\Users\UsersFixtures;
use App\Services\Files\CacheData\PurgeDataCache;
use App\Services\Files\Path\UploadsFilesPath;
use App\Services\Files\Uploads\PurgeUploads;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\ConnectionException;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @var Fixtures[] $fixtures
     */
    protected $fixtures;

    /**
     * @var PurgeDataCache $purgeDataCache
     */
    protected $purgeDataCache;

    /**
     * @var PurgeUploads $purgeUploads
     */
    protected $purgeUploads;

    public function __construct(
        PurgeDataCache          $purgeDataCache,
        PurgeUploads            $purgeUploads,
        UsersFixtures           $usersFixtures,
        AffiliationsFixtures    $affiliationsFixtures,
        TagsFixture             $tagsFixture,
        HomepageFixtures        $homepageFixtures,
        PageFixtures            $pageFixtures,
        CategoriesFixtures      $categoriesFixtures,
        BlogFixtures            $blogFixtures,
        SlidersFixture          $slidersFixture,
        SettingsFixture         $settingsFixture
    ) {
        $this->purgeDataCache = $purgeDataCache;
        $this->purgeUploads = $purgeUploads;

        $this->insertFixtures($usersFixtures);
        $this->insertFixtures($affiliationsFixtures);
        $this->insertFixtures($tagsFixture);
        $this->insertFixtures($homepageFixtures);
        $this->insertFixtures($pageFixtures);
        $this->insertFixtures($categoriesFixtures);
        $this->insertFixtures($blogFixtures);
        $this->insertFixtures($slidersFixture);
        $this->insertFixtures($settingsFixture);
    }
    protected function insertFixtures(Fixtures $appFixtures)
    {
        $this->fixtures[] = $appFixtures;
    }

    public function load(ObjectManager $manager)
    {
        try {
            $this->purgeDataCache->purgeCache();
            $this->purgeUploads->purgeUploads();

            foreach ($this->fixtures as $fixture) {
                $fixture->load();
            }
        } catch (ConnectionException $connectionException) {
            dump($connectionException->getTrace());
        }
    }
}
