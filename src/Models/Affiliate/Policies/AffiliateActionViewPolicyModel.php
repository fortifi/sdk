<?php
namespace Fortifi\Sdk\Models\Affiliate\Policies;

use Fortifi\FortifiApi\Affiliate\Endpoints\Policies\AffiliateActionViewPolicyEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\ActionView\AffiliateActionViewPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\ActionView\RetrieveAffiliateActionViewPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\ActionView\ListAffiliateActionViewPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\ActionView\AffiliateActionViewPoliciesResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\ActionView\AffiliateActionViewPolicyResponse;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateActionViewPolicyModel extends FortifiApiModel
{
  /**
   * @param string $resourceFid;
   *
   * @return AffiliateActionViewPoliciesResponse|FortifiApiRequestInterface
   */
  public function all($resourceFid = null)
  {
    $payload = new ListAffiliateActionViewPolicyPayload();
    $payload->resourceFid = $resourceFid;

    $ep = AffiliateActionViewPolicyEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $resourceFid
   * @param string $actionKey
   *
   * @return AffiliateActionViewPolicyResponse|FortifiApiRequestInterface
   */
  public function retrieve($resourceFid, $actionKey)
  {
    $payload = new RetrieveAffiliateActionViewPolicyPayload();
    $payload->resourceFid = $resourceFid;
    $payload->actionKey = $actionKey;

    $ep = AffiliateActionViewPolicyEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $resourceFid
   * @param string $actionKey
   * @param string $canView
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function create($resourceFid, $actionKey, $canView)
  {
    $payload = new AffiliateActionViewPolicyPayload();
    $payload->resourceFid = $resourceFid;
    $payload->actionKey = $actionKey;
    $payload->canView = $canView;

    $ep = AffiliateActionViewPolicyEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $resourceFid
   * @param string $actionKey
   * @param string $canView
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($resourceFid, $actionKey, $canView)
  {
    $payload = new AffiliateActionViewPolicyPayload();
    $payload->resourceFid = $resourceFid;
    $payload->actionKey = $actionKey;
    $payload->canView = $canView;

    $ep = AffiliateActionViewPolicyEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }
}
