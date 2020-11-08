<?php
namespace App\Services\Pages\Resource\Factory;

use App\Entity\Entities\Subpages\Resources;
use App\Entity\Entities\Subpages\Subpages;
use App\Services\Pages\Resource\Factory\Slug\Interfaces\Sluggable;
use App\Services\System\Factory\Factory;
use App\Services\System\Locale\Interfaces\LocaleInterface;
use Doctrine\ORM\EntityManagerInterface;

abstract class SubpageFactory extends Factory
{
    /**
     * @var Sluggable $slugGenerator
     */
    protected $slugGenerator;
    /**
     * @var LocaleInterface $locale
     */
    protected $locale;

    /**
     * @var Subpages $subpage
     */
    protected $subpage;


    public function __construct(
        EntityManagerInterface $entityManager,
        Sluggable $sluggable,
        LocaleInterface $locale
    ) {
        parent::__construct($entityManager);
        $this->slugGenerator = $sluggable;
        $this->locale = $locale;
    }
    protected function afterSubpageCreated(){}

    protected function getLocale(string $locale = null)
    {
        return $locale ?: $this->locale->getLocale();
    }

    /**
     * @param Resources   $resource
     * @param string      $name
     * @param string|null $locale
     * @return Subpages
     */
    public function factory(Resources $resource, string $name, string $locale = null)
    {
        $this->subpage = new Subpages($name, $this->getLocale($locale));
        $resource->addSubpage($this->subpage);

        $this->slugGenerator->slugGenerateSubpage($this->subpage);
        $this->afterSubpageCreated();
        return $this->subpage;
    }
}
