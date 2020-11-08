<?php
namespace App\Application\SiteWide\Links;

use App\Application\SiteWide\FrontInitInterface;

class NavbarLinks implements FrontInitInterface
{
    public function getValue(): array
    {
        return [
            [
                'name' => 'Strona Główna',
                'link' => '/',
            ],
            [
                'name' => 'Promocje',
                'link' => '/promocje',
            ],
            [
                'name' => 'Sklepy',
                'link' => '/sklepy',
            ],
            [
                'name' => 'Blog',
                'link' => '/blog',
            ],
        ];
    }
    public function getName(): string
    {
        return 'navbar';
    }
}
