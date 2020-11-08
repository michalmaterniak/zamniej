<?php
namespace App\DataFixtures;

use App\Entity\Entities\System\Contents;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use ErrorException;
use Faker\Factory;
use Faker\Generator;

abstract class Fixtures
{
    /**
     * @var Fixtures[] $fixtures
     */
    protected $fixtures = [];

    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var ArrayCollection[]|null $array
     */
    private static $array = null;

    /**
     * @var Generator $fakerPl
     */
    protected $fakerPl;

    /**
     * @var Generator $fakerEn
     */
    protected $fakerEn;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->fakerPl = Factory::create('pl_PL');
        $this->fakerEn = Factory::create('en_US');
        if (self::$array == null) {
            self::$array = new ArrayCollection();
        }
    }

    abstract public function load();

    /**
     * @return ArrayCollection
     */
    public static function getArray(): ArrayCollection
    {
        return self::$array;
    }

    protected static function parseResource(string $resource)
    {
        $name = $resource;
        $name = str_replace('App\DataFixtures\\', '', $name);
        $name = strtolower($name);
        $name = str_replace('\\', '_', $name);

        return $name;
    }

    protected static function getName()
    {
        return self::parseResource(static::class);
    }

    public function fakeContent(Contents $content, $locale = 'pl')
    {

        switch ($locale) {
            case 'en':
            {
                $contentT = "<p>{$this->fakerEn->unique()->realText(1000, 5)}</p>";
                $contentT .= "<p>{$this->fakerEn->unique()->realText(1000, 5)}</p>";
                $contentT .= "<p>{$this->fakerEn->unique()->realText(1000, 5)}</p>";
                $contentT .= "<p>{$this->fakerEn->unique()->realText(1000, 5)}</p>";
                $content->setContent($contentT);
                break;
            }
            case 'pl':
            {
                $contentT = "<p>{$this->fakerPl->unique()->realText(1000, 5)}</p>";
                $contentT .= "<p>{$this->fakerPl->unique()->realText(1000, 5)}</p>";
                $contentT .= "<p>{$this->fakerPl->unique()->realText(1000, 5)}</p>";
                $contentT .= "<p>{$this->fakerPl->unique()->realText(1000, 5)}</p>";
                $content->setContent($contentT);
                break;
            }
        }
    }
    protected static function getFixture(string $key, $empty = null)
    {
        return self::$array[$key] ?? $empty;
    }

    /**
     * @param $value
     * @param string|null $key
     * @throws ErrorException
     */
    protected static function addFixture($value, string $key = null)
    {
        self::$array->set($key ?: static::getName(), $value);
    }
}
