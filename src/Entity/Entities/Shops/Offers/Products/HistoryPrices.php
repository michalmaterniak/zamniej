<?php
namespace App\Entity\Entities\Shops\Offers\Products;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class HistoryPrices
 * @package App\Entity\Entities\Shops\Offers\Products
 *
 * @ORM\Table(name="history_prices")
 */
class HistoryPrices
{
    /**
     * @var int $idPrice
     * @ORM\Column(name="id_price", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin-listing"})
     */
    protected $idPrice;
}
