<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateVisitorEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Visitor\VisitorPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Visitor\VisitorReferencePayload;
use Fortifi\FortifiApi\Affiliate\Responses\Visitor\VisitorReferencesResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Visitor\VisitorEventsResponse;
use Fortifi\FortifiApi\Affiliate\Responses\AffiliatesResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateVisitorModel extends FortifiApiModel
{
  /**
   * @param int $visitorId
   *
   * @return FortifiApiRequestInterface|VisitorReferencesResponse
   */
  public function references($visitorId)
  {
    $payload = new VisitorReferencePayload();
    $payload->visitorId = $visitorId;

    $ep = AffiliateVisitorEndpoint::bound($this->getApi());
    return $ep->references($payload)->get();
  }

  /**
   * @param int    $visitorId
   *
   * @return FortifiApiRequestInterface|AffiliatesResponse
   */
  public function contributors($visitorId)
  {
    $payload = new VisitorPayload();
    $payload->visitorId = $visitorId;

    $ep = AffiliateVisitorEndpoint::bound($this->getApi());
    return $ep->contributors($payload)->get();
  }

  /**
   * @param string $visitorId
   *
   * @return FortifiApiRequestInterface|VisitorEventsResponse
   */
  public function events($visitorId)
  {
    $payload = new VisitorPayload();
    $payload->visitorId = $visitorId;

    $ep = AffiliateVisitorEndpoint::bound($this->getApi());
    return $ep->events($payload)->get();
  }
}
