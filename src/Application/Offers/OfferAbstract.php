<?php
namespace App\Application\Offers;

use Symfony\Component\Serializer\Annotation\Groups;

abstract class OfferAbstract
{
    /**
     * @return string
     * @Groups({"resource"})
     */
    abstract public function getTypeOffer() : string;

    /**
     * @var OfferComponents $components
     */
    protected $components;

    /**
     * @param OfferComponents $components
     * @required
     */
    public function setComponents(OfferComponents $components): void
    {
        $this->components = $components;
    }

    /**
     * @return OfferComponents
     */
    public function getComponents(): OfferComponents
    {
        return $this->components;
    }
}
