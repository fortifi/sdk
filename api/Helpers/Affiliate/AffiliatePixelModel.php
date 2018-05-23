<?php
namespace Fortifi\FortifiApi\Helpers\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliatePixelEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\CreatePixelPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\ListPixelPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\PixelApprovalPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\RetrievePendingPixelsPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\UpdatePixelPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelHistoriesResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelPoliciesResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelPolicyResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelsResponse;
use Fortifi\FortifiApi\Foundation\Exceptions\NotFoundException;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\ToggleFidPayload;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Helpers\Api\FortifiApiModel;

/**
 * @deprecated
 */
class AffiliatePixelModel extends FortifiApiModel
{
  /**
   * @param string $affiliateFid
   * @param bool   $showPending
   *
   * @return PixelPoliciesResponse
   */
  public function all($affiliateFid = null, $showPending = null)
  {
    $payload = new ListPixelPayload();
    $payload->affiliateFid = $affiliateFid;
    $payload->showPending = $showPending;

    $ep = AffiliatePixelEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $affiliateFid
   * @param string $pixelType
   * @param string $url
   * @param string $content
   * @param string $action
   * @param string $campaignFid
   * @param string $sid1
   * @param string $sid2
   * @param string $sid3
   * @param string $displayName
   * @param string $platform
   * @param string $country
   * @param bool   $active
   *
   * @return PixelPolicyResponse
   */
  public function create(
    $affiliateFid, $pixelType, $url, $content, $action = null,
    $campaignFid = null, $sid1 = null, $sid2 = null, $sid3 = null,
    $displayName = null, $platform = null, $country = null, $active = true
  )
  {
    $payload = new CreatePixelPayload();
    $payload->affiliateFid = $affiliateFid;
    $payload->action = $action;
    $payload->campaignFid = $campaignFid;
    $payload->sid1 = $sid1;
    $payload->sid2 = $sid2;
    $payload->sid3 = $sid3;
    $payload->displayName = $displayName;
    $payload->pixelType = $pixelType;
    $payload->url = $url;
    $payload->content = $content;
    $payload->platform = $platform;
    $payload->country = $country;
    $payload->active = $active;

    $ep = AffiliatePixelEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $pixelFid
   * @param string $displayName
   * @param string $pixelType
   * @param string $url
   * @param string $content
   *
   * @return BoolResponse
   * @throws NotFoundException
   */
  public function update($pixelFid, $displayName, $pixelType, $url, $content)
  {
    $payload = new UpdatePixelPayload();
    $payload->fid = $pixelFid;
    $payload->displayName = $displayName;
    $payload->pixelType = $pixelType;
    $payload->url = $url;
    $payload->content = $content;

    $ep = AffiliatePixelEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param string $fid
   * @param bool   $state
   *
   * @return BoolResponse
   */
  public function setState($fid, $state)
  {
    $payload = new ToggleFidPayload();
    $payload->state = $state;
    $payload->fid = $fid;

    $ep = AffiliatePixelEndpoint::bound($this->getApi());
    return $ep->setState($payload)->get();
  }

  /**
   * @param string $pixelFid
   *
   * @return PixelHistoriesResponse
   */
  public function history($pixelFid)
  {
    $payload = new FidPayload();
    $payload->fid = $pixelFid;

    $ep = AffiliatePixelEndpoint::bound($this->getApi());
    return $ep->history($payload)->get();
  }

  /**
   * @param string $pixelFid
   * @param bool   $approve
   *
   * @return BoolResponse
   * @throws NotFoundException
   */
  public function approve($pixelFid, $approve = true)
  {
    $payload = new PixelApprovalPayload();
    $payload->fid = $pixelFid;
    $payload->approved = $approve;

    $ep = AffiliatePixelEndpoint::bound($this->getApi());
    return $ep->approve($payload)->get();
  }

  /**
   * @param string $pixelFid
   *
   * @return PixelPolicyResponse
   * @throws NotFoundException
   */
  public function retrieve($pixelFid)
  {
    $payload = new FidPayload();
    $payload->fid = $pixelFid;

    $ep = AffiliatePixelEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $pixelFid
   *
   * @return BoolResponse
   * @throws NotFoundException
   */
  public function delete($pixelFid)
  {
    $payload = new FidPayload();
    $payload->fid = $pixelFid;

    $ep = AffiliatePixelEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param string $pixelFid
   *
   * @return BoolResponse
   * @throws NotFoundException
   */
  public function restore($pixelFid)
  {
    $payload = new FidPayload();
    $payload->fid = $pixelFid;

    $ep = AffiliatePixelEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }

  /**
   * @param string $visitorId
   *
   * @return PixelsResponse
   */
  public function getPending($visitorId)
  {
    $payload = new RetrievePendingPixelsPayload();
    $payload->visitorId = $visitorId;

    $ep = AffiliatePixelEndpoint::bound($this->getApi());
    return $ep->getPending($payload)->get();
  }
}
