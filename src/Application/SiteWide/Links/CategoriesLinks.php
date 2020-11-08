<?php
namespace App\Application\SiteWide\Links;

use App\Application\SiteWide\FrontInitInterface;

class CategoriesLinks implements FrontInitInterface
{
    public function getValue(): array
    {
        return [
            'categories' => [
                [
                    'name' => 'Biżuteria i zegarki',
                    'link' => '/kategorie/bizuteria-i-zegarki',
                ],
                [
                    'name' => 'Dla Dziecka',
                    'link' => '/kategorie/dla-dziecka-parenting',
                ],
                [
                    'name' => 'Dom i ogród',
                    'link' => '/kategorie/dom-i-ogrod',
                ],
                [
                    'name' => 'Elektronika',
                    'link' => '/kategorie/elektronika',
                ],
                [
                    'name' => 'Zdrowie i uroda',
                    'link' => '/kategorie/zdrowie-i-uroda',
                ],
                [
                    'name' => 'Artykuły dla zwierząt',
                    'link' => '/kategorie/zwierzeta',
                ],
            ],
            'category' => [
                'name' => 'Zobacz więcej',
                'link' => '/kategorie',
            ],
        ];
    }
    public function getName(): string
    {
        return 'categories';
    }
}
