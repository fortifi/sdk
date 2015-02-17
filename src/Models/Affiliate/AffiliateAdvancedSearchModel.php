<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateAdvancedSearchEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\AdvancedSearch\AffiliateAdvancedSearchCampaignHashPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\AdvancedSearch\AffiliateAdvancedSearchEmailPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\AdvancedSearch\AffiliateAdvancedSearchTrackingLinkPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\AdvancedSearch\AffiliateAdvancedSearchWebsitePayload;
use Fortifi\FortifiApi\Affiliate\Responses\AffiliateResponse;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateAdvancedSearchModel extends FortifiApiModel
{
  /**
   * @param string $email
   *
   * @return FortifiApiRequestInterface|AffiliateResponse
   */
  public function email($email)
  {
    $payload        = new AffiliateAdvancedSearchEmailPayload();
    $payload->email = $email;

    $ep = AffiliateAdvancedSearchEndpoint::bound($this->getApi());
    return $ep->email($payload)->get();
  }

  /**
   * @param string $campaignHash
   *
   * @return FortifiApiRequestInterface|AffiliateResponse
   */
  public function campaignHash($campaignHash)
  {
    $payload                = new AffiliateAdvancedSearchCampaignHashPayload();
    $payload->campaignHash  = $campaignHash;

    $ep = AffiliateAdvancedSearchEndpoint::bound($this->getApi());
    return $ep->campaignHash($payload)->get();
  }

  /**
   * @param string $trackingLink
   *
   * @return FortifiApiRequestInterface|AffiliateResponse
   */
  public function trackingLink($trackingLink)
  {
    $payload                = new AffiliateAdvancedSearchTrackingLinkPayload();
    $payload->trackingLink  = $trackingLink;

    $ep = AffiliateAdvancedSearchEndpoint::bound($this->getApi());
    return $ep->trackingLink($payload)->get();
  }

  /**
   * @param string $website
   *
   * @return FortifiApiRequestInterface|AffiliateResponse
   */
  public function website($website)
  {
    $payload          = new AffiliateAdvancedSearchWebsitePayload();
    $payload->website = $website;

    $ep = AffiliateAdvancedSearchEndpoint::bound($this->getApi());
    return $ep->website($payload)->get();
  }
}
