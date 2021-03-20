<?php

namespace App\Application\Locale;

use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Repositories\Subpages\SubpagesRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class FinderSubpageBySlug
{

    /**
     * @var SubpagesRepository $subpagesRepository
     */
    protected $subpagesRepository;

    /**
     * @var Locale $locale
     */
    protected $locale;

    /**
     * @var RequestStack $requestStack
     */
    protected $requestStack;

    /**
     * @var string $url
     */
    protected $url;

    public function __construct(
        Locale $locale,
        SubpagesRepository $subpagesRepository
    )
    {
        $this->subpagesRepository = $subpagesRepository;
        $this->locale = $locale;
    }

    public function getSubpageByUrl(string $url): ?Subpages
    {
        $this->url = $url;
        $this->remove();
        return $this->subpagesRepository->select()->slug(
            $this->url
        )->locale($this->locale->getLocale())->getResultOrNull();
    }

    protected function remove()
    {
        $this->url = str_replace(
            $this->locale->getAddress(),
            '',
            $this->url
        );
    }
}
