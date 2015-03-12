<?php
namespace Fortifi\Sdk\Models\Affiliate\Policies;

use Fortifi\FortifiApi\Affiliate\Endpoints\Policies\AffiliateTrafficBlockingPolicyEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\ListAffiliatePolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\TrafficBlocking\CreateAffiliateTrafficBlockingPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\TrafficBlocking\UpdateAffiliateTrafficBlockingPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\TrafficBlocking\AffiliateTrafficBlockingPoliciesResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\TrafficBlocking\AffiliateTrafficBlockingPolicyResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\TrafficBlocking\CreateAffiliateTrafficBlockingPolicyResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateTrafficBlockingPolicyModel extends FortifiApiModel
{
  /**
   * @param string $companyFid;
   * @param string $affiliateFid;
   * @param string $foundationFid;
   *
   * @return AffiliateTrafficBlockingPoliciesResponse|FortifiApiRequestInterface
   */
  public function all(
    $companyFid = null, $affiliateFid = null, $foundationFid = null
  )
  {
    $payload = new ListAffiliatePolicyPayload();
    $payload->companyFid = $companyFid;
    $payload->affiliateFid = $affiliateFid;
    $payload->foundationFid = $foundationFid;

    $ep = AffiliateTrafficBlockingPolicyEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AffiliateTrafficBlockingPolicyResponse|FortifiApiRequestInterface
   */
  public function retrieve($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateTrafficBlockingPolicyEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $companyFid
   * @param string $resourceFid
   * @param string $campaignHash
   * @param string $sid1
   * @param string $sid2
   * @param string $sid3
   * @param string $action
   * @param string $country
   * @param string $platform
   * @param string $description
   * @param string $redirectUrl
   * @param string $blockMessage
   *
   * @return FortifiApiRequestInterface|CreateAffiliateTrafficBlockingPolicyResponse
   */
  public function create(
    $companyFid, $resourceFid, $campaignHash,
    $sid1, $sid2, $sid3, $action, $country, $platform, $description,
    $redirectUrl, $blockMessage
  )
  {
    $payload = new CreateAffiliateTrafficBlockingPolicyPayload();
    $payload->companyFid = (string)$companyFid;
    $payload->resourceFid = $resourceFid;
    $payload->campaignHash = (string)$campaignHash;
    $payload->sid1 = (string)$sid1;
    $payload->sid2 = (string)$sid2;
    $payload->sid3 = (string)$sid3;
    $payload->action = $action;
    $payload->country = $country;
    $payload->platform = $platform;
    $payload->description = $description;
    $payload->redirectUrl = $redirectUrl;
    $payload->blockMessage = $blockMessage;

    $ep = AffiliateTrafficBlockingPolicyEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $description
   * @param string $redirectUrl
   * @param string $blockMessage
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($fid, $description, $redirectUrl, $blockMessage)
  {
    $payload = new UpdateAffiliateTrafficBlockingPolicyPayload();
    $payload->fid = $fid;
    $payload->description = $description;
    $payload->redirectUrl = $redirectUrl;
    $payload->blockMessage = $blockMessage;

    $ep = AffiliateTrafficBlockingPolicyEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function delete($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateTrafficBlockingPolicyEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function restore($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateTrafficBlockingPolicyEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }
}
