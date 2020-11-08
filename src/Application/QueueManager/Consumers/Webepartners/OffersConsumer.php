<?php
namespace App\Application\QueueManager\Consumers\Webepartners;

use App\Application\Affiliations\Webepartners\OffersFactoryWebepartners;
use App\Services\QueueManager\Interfaces\Consumer;

class OffersConsumer implements Consumer
{
    /**
     * @var OffersFactoryWebepartners $offersFactory
     */
    protected $offersFactory;

    public function __construct(OffersFactoryWebepartners $offersFactory)
    {
        $this->offersFactory = $offersFactory;
    }

    public function run(array $data): void
    {
        $this->offersFactory->save($data['program']);
    }
}
