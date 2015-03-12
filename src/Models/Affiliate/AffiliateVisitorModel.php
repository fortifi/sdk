<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Payloads\Visitor\VisitorEventPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Visitor\VisitorEventResponse;
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
   * @param int $visitorId
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

  /**
   * @param string $visitorId
   * @param string $eventId
   *
   * @return FortifiApiRequestInterface|VisitorEventResponse
   */
  public function event($visitorId, $eventId)
  {
    $payload = new VisitorEventPayload();
    $payload->visitorId = $visitorId;
    $payload->eventId = $eventId;

    $ep = AffiliateVisitorEndpoint::bound($this->getApi());
    return $ep->event($payload)->get();
  }
}
