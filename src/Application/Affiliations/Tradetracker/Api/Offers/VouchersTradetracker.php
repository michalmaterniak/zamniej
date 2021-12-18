<?php

namespace App\Application\Affiliations\Tradetracker\Api\Offers;

class VouchersTradetracker extends PromotionsTradetracker
{
    protected function getMaterialIncentiveItems(int $affiliateSiteID) {
        return $this->tradetrackerAuthorization->getSoap()->getMaterialIncentiveVoucherItems($affiliateSiteID, 'html', []);
    }
}
