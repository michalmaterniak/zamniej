<?php
namespace App\Application\Affiliations\Webepartners\Api\Categories;

use App\Application\Affiliations\Webepartners\Api\Webepartners;

class CategoriesWebepartners extends Webepartners
{
    protected function getUrl(): string
    {
        return 'https://api2.webepartners.pl/Wydawca/GetCategoryTree';
    }

    /**
     * @return array
     */
    public function getCategoriesTree()
    {
        return $this->getResponse();
    }
}
