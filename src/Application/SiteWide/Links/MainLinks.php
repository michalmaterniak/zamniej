<?php
namespace App\Application\SiteWide\Links;

use App\Application\SiteWide\FrontInitInterface;

class MainLinks implements FrontInitInterface
{
    /**
     * @var CategoriesLinks $categoriesLinks
     */
    protected $categoriesLinks;

    /**
     * @var FooterLinks $footerLinks
     */
    protected $footerLinks;

    /**
     * @var NavbarLinks $navbarLinks
     */
    protected $navbarLinks;

    /**
     * @var PopularShopsLinks $popularShopsLinks
     */
    protected $popularShopsLinks;

    public function __construct(
        CategoriesLinks $categoriesLinks,
        FooterLinks $footerLinks,
        NavbarLinks $navbarLinks,
        PopularShopsLinks $popularShopsLinks
    ) {
        $this->categoriesLinks = $categoriesLinks;
        $this->footerLinks = $footerLinks;
        $this->navbarLinks = $navbarLinks;
        $this->popularShopsLinks = $popularShopsLinks;
    }

    public function getValue(): array
    {
        return [
            $this->navbarLinks->getName() => $this->navbarLinks->getValue(),
            $this->footerLinks->getName() => $this->footerLinks->getValue(),
            $this->categoriesLinks->getName() => $this->categoriesLinks->getValue(),
            $this->popularShopsLinks->getName() => $this->popularShopsLinks->getValue(),
        ];
    }
    public function getName(): string
    {
        return 'links';
    }
}
