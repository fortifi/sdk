<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\Policies\AffiliatePixelPolicyEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\CreatePixelPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\ListPixelPoliciesPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\PixelApprovalPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\UpdatePixelPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelPoliciesResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelPolicyResponse;
use Fortifi\FortifiApi\Foundation\Exceptions\NotFoundException;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliatePixelModel extends FortifiApiModel
{
  /**
   * @param string $affiliateFid
   *
   * @return PixelPoliciesResponse|FortifiApiRequestInterface
   */
  public function all($affiliateFid)
  {
    $payload = new ListPixelPoliciesPayload();
    $payload->affiliateFid = $affiliateFid;

    $ep = AffiliatePixelPolicyEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $affiliateFid
   * @param string $action
   * @param string $campaign
   * @param string $sid1
   * @param string $sid2
   * @param string $sid3
   * @param string $displayName
   * @param string $pixelType
   * @param string $url
   * @param string $content
   * @param string $platform
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function create(
    $affiliateFid, $action, $campaign, $sid1, $sid2, $sid3,
    $displayName, $pixelType, $url, $content, $platform
  )
  {
    $payload = new CreatePixelPolicyPayload();
    $payload->resourceFid = $affiliateFid;
    $payload->action = $action;
    $payload->campaignHash = $campaign;
    $payload->sid1 = $sid1;
    $payload->sid2 = $sid2;
    $payload->sid3 = $sid3;
    $payload->displayName = $displayName;
    $payload->pixelType = $pixelType;
    $payload->url = $url;
    $payload->content = $content;
    $payload->platform = $platform;
    $payload->companyFid = '';
    $payload->country = '';

    $ep = AffiliatePixelPolicyEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $pixelFid
   * @param string $displayName
   * @param string $pixelType
   * @param string $url
   * @param string $content
   *
   * @return BoolResponse|FortifiApiRequestInterface
   * @throws NotFoundException
   */
  public function update($pixelFid, $displayName, $pixelType, $url, $content)
  {
    $payload = new UpdatePixelPolicyPayload();
    $payload->fid = $pixelFid;
    $payload->displayName = $displayName;
    $payload->pixelType = $pixelType;
    $payload->url = $url;
    $payload->content = $content;

    $ep = AffiliatePixelPolicyEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param string $pixelFid
   * @param bool   $approve
   *
   * @return BoolResponse|FortifiApiRequestInterface
   * @throws NotFoundException
   */
  public function approve($pixelFid, $approve = true)
  {
    $payload = new PixelApprovalPayload();
    $payload->fid = $pixelFid;
    $payload->approved = $approve;

    $ep = AffiliatePixelPolicyEndpoint::bound($this->getApi());
    return $ep->approve($payload)->get();
  }

  /**
   * @param string $pixelFid
   *
   * @return PixelPolicyResponse|FortifiApiRequestInterface
   * @throws NotFoundException
   */
  public function retrieve($pixelFid)
  {
    $payload = new FidPayload();
    $payload->fid = $pixelFid;

    $ep = AffiliatePixelPolicyEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $pixelFid
   *
   * @return BoolResponse|FortifiApiRequestInterface
   * @throws NotFoundException
   */
  public function delete($pixelFid)
  {
    $payload = new FidPayload();
    $payload->fid = $pixelFid;

    $ep = AffiliatePixelPolicyEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param string $pixelFid
   *
   * @return BoolResponse|FortifiApiRequestInterface
   * @throws NotFoundException
   */
  public function restore($pixelFid)
  {
    $payload = new FidPayload();
    $payload->fid = $pixelFid;

    $ep = AffiliatePixelPolicyEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }
}
