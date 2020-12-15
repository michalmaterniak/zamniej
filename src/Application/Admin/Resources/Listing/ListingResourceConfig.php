<?php
namespace App\Application\Admin\Resources\Listing;

use App\Application\Admin\Resources\Listing\ChildrenConfig\ChildrenConfigAdapter;
use App\Services\Pages\Resource\Resource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ListingResourceConfig
{
    /**
     * @var NormalizerInterface $normalizer
     */
    protected $normalizer;
    /**
     * @var ChildrenConfigAdapter $childrenConfigAdapter
     */
    protected $childrenConfigAdapter;

    public function __construct(
        NormalizerInterface $normalizer,
        ChildrenConfigAdapter $childrenConfig
    )
    {
        $this->normalizer = $normalizer;
        $this->childrenConfigAdapter = $childrenConfig;
    }

    /**
     * @param Resource $resource
     * @return ArrayCollection
     */
    public function getConfigListing(Resource $resource)
    {
        $this->childrenConfigAdapter->setResource($resource);

        return new ArrayCollection([
            $this->childrenConfigAdapter->getName() => $this->normalizer->normalize($this->childrenConfigAdapter->getValue(), null, ['admin'])
        ]);
    }
}
