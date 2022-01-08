<?php

namespace App\Application\Affiliations\Tradetracker\Urls;

use App\Application\Affiliations\Interfaces\Urls\UrlTrackingConverterInterface;
use App\Entity\Entities\Affiliations\ShopsAffiliation;

class UrlToTrackingConverterTradetracker implements UrlTrackingConverterInterface
{
    /**
     * @var int $siteId
     */
    protected $siteId;

    /**
     * @var ShopsAffiliation $shopAffiliation
     */
    protected $shopAffiliation = null;

    /**
     * @var string $url
     */
    protected $url;

    const FORMAT_URL = 'https://tc.tradetracker.net/?c=%d&m=12&a=%d&r=&u=%s';

    /**
     * @param array $tradetracker
     * @todo klasa dziala tylko dla jeden stony. jak sie doda kolejna to bedzie trzeba duzo przerabiac ;(
     * np. dodać do bazy do shop_affiliations pole z siteId albo jakis mapping
     */
    public function __construct(
        array $tradetracker
    ) {
        $this->siteId = $tradetracker['affiliateSiteIDs'][0]; // pierwszy, glupi pomysl z tą tablicą :(
    }

    public function setShopAffiliation(ShopsAffiliation $shopAffiliation)
    {
        $this->shopAffiliation = $shopAffiliation;
    }

    /**
     * @param string $subpage
     * @return string|null
     */
    public function getUrl(string $subpage): ?string
    {
        $this->url = $subpage;

        if (filter_var($this->url, FILTER_VALIDATE_URL) === false) {
            return null;
        }

        if (!$this->shopAffiliation) {
            return null;
        }

        return $this->generate();
    }

    protected function generate() {
        $url = parse_url($this->url);
        $query = $url['query'] ?? '';
        $url = urlencode(($url['path'] ?? '') . ($query ? ('?' . $query) : ''));

        return sprintf(self::FORMAT_URL, $this->shopAffiliation->getExternalId(), $this->siteId, $url);
    }
}
