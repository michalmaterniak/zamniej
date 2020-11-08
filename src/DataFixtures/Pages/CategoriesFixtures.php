<?php
namespace App\DataFixtures\Pages;

use App\Application\Pages\Category\Factory\CategoryFactory;
use App\Application\Pages\Page\Types\Categories\Categories;
use App\Application\Pages\PagesManager;
use App\DataFixtures\Settings\SettingsFixture;
use Doctrine\ORM\EntityManagerInterface;

class CategoriesFixtures extends AbstractPageFixtures
{

    /**
     * @var array|Categories[]
     */
    protected $categories;

    /**
     * @var SettingsFixture $settingsFixture
     */
    protected $settingsFixture;

    /**
     * @var Categories $categoriesModel
     */
    protected $categoriesModel;

    /**
     * @var CategoryFactory $categoryFactory
     */
    protected $categoryFactory;

    public function __construct(
        EntityManagerInterface  $entityManager,
        SettingsFixture         $settingsFixture,
        PagesManager            $modelPagesManager,
        CategoryFactory         $categoryFactory
    ) {
        parent::__construct($entityManager, $settingsFixture, $modelPagesManager);
        $this->categoryFactory = $categoryFactory;
    }

    public function saveCategory(string $name, array $data)
    {
        $factory = $this->categoryFactory->create($name, $this->categoriesModel->getModelEntity(), $data);
        $factory->save();
        dump('created '.$name);
    }

    public function load()
    {
        $this->categoriesModel = static::getFixture('categories');
        $categoriesName = [
            'Architektura miejska' => [
                'logo' => __DIR__.'/category_resources/chicago-690364.jpg',
            ],
            'Artykuły plastyczne' => [
                'logo' => __DIR__.'/category_resources/crayons-4902112.jpg',
            ],
            'Biuro i firma' => [
                'logo' => __DIR__.'/category_resources/writing-1149962_1920.jpg',
            ],
            'Biżuteria i zegarki' => [
                'logo' => __DIR__.'/category_resources/wristwatch-407096_1920.jpg',
            ],
            'Broń i militaria' => [
                'logo' => __DIR__.'/category_resources/camouflage-3774818_1920.jpg',
            ],
            'Dla dziecka, parenting' => [
                'logo' => __DIR__.'/category_resources/baby-1151351_1920.jpg',
            ],
            'Dom i ogród' => [
                'logo' => __DIR__.'/category_resources/house-1450586_1920.jpg',
            ],
            'Elektronika' => [
                'logo' => __DIR__.'/category_resources/service-428540_1920.jpg',
            ],
            'Erotyka' => [
                'logo' => __DIR__.'/category_resources/girl-2047939_1920.jpg',
            ],
            'Gadżety' => [
                'logo' => __DIR__.'/category_resources/gadgets-336635_1920.jpg',
            ],
            'Książki, muzyka, filmy' => [
                'logo' => __DIR__.'/category_resources/reading-3088491_1920.jpg',
            ],
            'Jedzenie' => [
                'logo' => __DIR__ . '/category_resources/olive-oil-1412361_1920.jpg',
            ],
            'Lifestyle' => [
                'logo' => __DIR__.'/category_resources/people-2604149_1920.jpg',
            ],
            'Moda' => [
                'logo' => __DIR__.'/category_resources/beautiful-1274056_1920.jpg',
            ],
            'Motoryzacja' => [
                'logo' => __DIR__.'/category_resources/car-2275763_1920.jpg',
            ],
            'Multibranżowy' => [
                'logo' => __DIR__.'/category_resources/store-1245758_1920.jpg',
            ],
            'Podróże' => [
                'logo' => __DIR__.'/category_resources/boat-4388160_1920.jpg',
            ],
            'Pożyczki i finanse' => [
                'logo' => __DIR__.'/category_resources/entrepreneur-1340649_1920.jpg',
            ],
            'Sport i rekreacja' => [
                'logo' => __DIR__.'/category_resources/tennis-1381230_1920.jpg',
            ],
            'Szkolenia' => [
                'logo' => __DIR__.'/category_resources/open-book-1428428_1920.jpg',
            ],
            'Usługi' => [
                'logo' => __DIR__.'/category_resources/bar-498420_1920.jpg',
            ],
            'Zdrowie i uroda' => [
                'logo' => __DIR__.'/category_resources/smoothies-2253423_1920.jpg',
            ],
            'Zwierzęta' => [
                'logo' => __DIR__.'/category_resources/cat-3535404_1920.jpg',
            ],
        ];
        foreach ($categoriesName as $name => $data) {
            $this->saveCategory($name, $data);
        }
        $this->settingsFixutres->createSeoSetting('Categories-Category');

        static::addFixture($this->categories, 'categories');

        dump('created categories');
    }
}
