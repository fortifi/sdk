<?php
namespace Fortifi\Sdk\Models\Affiliate\Policies;

use Fortifi\FortifiApi\Affiliate\Endpoints\Policies\AffiliateCommissionPolicyEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\Commission\CreateAffiliateCommissionPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\Commission\UpdateAffiliateCommissionPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\FindAffiliatePolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\ListAffiliatePolicyPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\Commission\AffiliateCommissionPoliciesResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\Commission\AffiliateCommissionPolicyResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\Commission\CreateAffiliateCommissionPolicyResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateCommissionPolicyModel extends FortifiApiModel
{
  /**
   * @param string $companyFid;
   * @param string $affiliateFid;
   * @param string $foundationFid;
   *
   * @return AffiliateCommissionPoliciesResponse|FortifiApiRequestInterface
   */
  public function all(
    $companyFid = null, $affiliateFid = null, $foundationFid = null
  )
  {
    $payload = new ListAffiliatePolicyPayload();
    $payload->companyFid = $companyFid;
    $payload->affiliateFid = $affiliateFid;
    $payload->foundationFid = $foundationFid;

    $ep = AffiliateCommissionPolicyEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AffiliateCommissionPolicyResponse|FortifiApiRequestInterface
   */
  public function retrieve($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateCommissionPolicyEndpoint::bound($this->getApi());
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
   * @param string $commission
   * @param bool   $isRevShare
   *
   * @return FortifiApiRequestInterface|CreateAffiliateCommissionPolicyResponse
   */
  public function create(
    $companyFid, $resourceFid, $campaignHash,
    $sid1, $sid2, $sid3, $action, $country, $platform, $description,
    $commission, $isRevShare
  )
  {
    $payload = new CreateAffiliateCommissionPolicyPayload();
    $payload->companyFid = $companyFid;
    $payload->resourceFid = $resourceFid;
    $payload->campaignHash = $campaignHash;
    $payload->sid1 = $sid1;
    $payload->sid2 = $sid2;
    $payload->sid3 = $sid3;
    $payload->action = $action;
    $payload->country = $country;
    $payload->platform = $platform;
    $payload->description = $description;
    $payload->commission = $commission;
    $payload->isRevShare = $isRevShare;

    $ep = AffiliateCommissionPolicyEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $description
   * @param string $commission
   * @param bool   $isRevShare
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($fid, $description, $commission, $isRevShare)
  {
    $payload = new UpdateAffiliateCommissionPolicyPayload();
    $payload->fid = $fid;
    $payload->description = $description;
    $payload->commission = $commission;
    $payload->isRevShare = $isRevShare;

    $ep = AffiliateCommissionPolicyEndpoint::bound($this->getApi());
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

    $ep = AffiliateCommissionPolicyEndpoint::bound($this->getApi());
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

    $ep = AffiliateCommissionPolicyEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }

  /**
   * @param string $companyFid;
   * @param string $affiliateFid;
   * @param string $foundationFid;
   * @param string $campaignHash
   * @param string $sid1
   * @param string $sid2
   * @param string $sid3
   * @param string $action
   * @param string $country
   * @param string $platform
   *
   * @return AffiliateCommissionPoliciesResponse|FortifiApiRequestInterface
   */
  public function find(
    $companyFid = null, $affiliateFid = null, $foundationFid = null,
    $campaignHash = null, $sid1 = null, $sid2 = null, $sid3 = null,
    $action = null, $country = null, $platform = null
  )
  {
    $payload = new FindAffiliatePolicyPayload();
    $payload->companyFid = $companyFid;
    $payload->affiliateFid = $affiliateFid;
    $payload->foundationFid = $foundationFid;
    $payload->campaignHash = $campaignHash;
    $payload->sid1 = $sid1;
    $payload->sid2 = $sid2;
    $payload->sid3 = $sid3;
    $payload->action = $action;
    $payload->country = $country;
    $payload->platform = $platform;

    $ep = AffiliateCommissionPolicyEndpoint::bound($this->getApi());
    return $ep->find($payload)->get();
  }
}
