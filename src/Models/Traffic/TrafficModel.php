<?php
namespace Fortifi\Sdk\Models\Traffic;

use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Traffic\Endpoints\TrafficEndpoint;
use Fortifi\FortifiApi\Traffic\Payloads\AffiliateVisitorPayload;
use Fortifi\FortifiApi\Traffic\Payloads\DevicePayload;
use Fortifi\FortifiApi\Traffic\Payloads\VisitorPayload;
use Fortifi\FortifiApi\Traffic\Responses\AffiliateVisitorResponse;
use Fortifi\FortifiApi\Traffic\Responses\DeviceResponse;
use Fortifi\FortifiApi\Traffic\Responses\DevicesResponse;
use Fortifi\FortifiApi\Traffic\Responses\VisitorResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class TrafficModel extends FortifiApiModel
{
  /**
   * @param int $visitorId
   *
   * @return FortifiApiRequestInterface|VisitorResponse
   */
  public function visitor($visitorId)
  {
    $payload = new VisitorPayload();
    $payload->visitorId = $visitorId;

    $ep = TrafficEndpoint::bound($this->getApi());
    return $ep->visitor($payload)->get();
  }

  /**
   * @param string $affiliateFid
   * @param int    $visitorId
   *
   * @return FortifiApiRequestInterface|AffiliateVisitorResponse
   */
  public function affiliateVisitor($affiliateFid, $visitorId)
  {
    $payload = new AffiliateVisitorPayload();
    $payload->affiliateFid = $affiliateFid;
    $payload->visitorId = $visitorId;

    $ep = TrafficEndpoint::bound($this->getApi());
    return $ep->affiliateVisitor($payload)->get();
  }

  /**
   * @param string $visitorId
   *
   * @return FortifiApiRequestInterface|DevicesResponse
   */
  public function devices($visitorId)
  {
    $payload = new VisitorPayload();
    $payload->visitorId = $visitorId;

    $ep = TrafficEndpoint::bound($this->getApi());
    return $ep->visitorDevices($payload)->get();
  }

  /**
   * @param string $deviceId
   *
   * @return FortifiApiRequestInterface|DeviceResponse
   */
  public function device($deviceId)
  {
    $payload = new DevicePayload();
    $payload->deviceId = $deviceId;

    $ep = TrafficEndpoint::bound($this->getApi());
    return $ep->device($payload)->get();
  }
}
