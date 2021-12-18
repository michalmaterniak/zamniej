<?php

namespace App\Application\Affiliations\Tradetracker\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Tradetracker
{
    protected array $tradetracker;

    protected Serializer $serializer;

    protected ArrayCollection $objects;

    public function __construct(protected TradetrackerAuthorization $tradetrackerAuthorization)
    {
        $this->tradetracker = $this->tradetrackerAuthorization->getTradetracker();
        $this->serializer = new Serializer([new ObjectNormalizer()]);
        $this->objects = new ArrayCollection();
    }
}
