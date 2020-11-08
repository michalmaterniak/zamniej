<?php
namespace App\DataFixtures\ShopTags;

use App\DataFixtures\Fixtures;
use App\Entity\Entities\Shops\Tags\ShopTags;

class TagsFixture extends Fixtures
{
    public function load()
    {
        $this->createTag('promocje w {{name}}');
        $this->createTag('Zniżki dla sklepu {{name}}');
        $this->createTag('najnowsze promocje w sklepie {{name}}');
        $this->createTag('{{name}} - zniżki i promocje');
        $this->createTag('{{name}} - najnowsze zniżki');
        $this->createTag('{{name}} rabaty, zniżki i promocje');
        $this->entityManager->flush();
    }
    protected function createTag(string $name, string $locale = 'pl')
    {
        $tag = new ShopTags();
        $tag->addTag($name, $locale);
        $this->entityManager->persist($tag);
    }
}
