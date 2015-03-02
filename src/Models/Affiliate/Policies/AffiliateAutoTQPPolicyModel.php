<?php
namespace Fortifi\Sdk\Models\Affiliate\Policies;

use Fortifi\FortifiApi\Affiliate\Endpoints\Policies\AffiliateAutoTQPPolicyEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\AutoTQP\CreateAffiliateAutoTQPPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\AutoTQP\UpdateAffiliateAutoTQPPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\ListAffiliatePolicyPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\AutoTQP\AffiliateAutoTQPPoliciesResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\AutoTQP\AffiliateAutoTQPPolicyResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\AutoTQP\CreateAffiliateAutoTQPPolicyResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateAutoTQPPolicyModel extends FortifiApiModel
{
  /**
   * @param string $companyFid;
   * @param string $affiliateFid;
   * @param string $foundationFid;
   *
   * @return AffiliateAutoTQPPoliciesResponse|FortifiApiRequestInterface
   */
  public function all(
    $companyFid = null, $affiliateFid = null, $foundationFid = null
  )
  {
    $payload = new ListAffiliatePolicyPayload();
    $payload->companyFid = $companyFid;
    $payload->affiliateFid = $affiliateFid;
    $payload->foundationFid = $foundationFid;

    $ep = AffiliateAutoTQPPolicyEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AffiliateAutoTQPPolicyResponse|FortifiApiRequestInterface
   */
  public function retrieve($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateAutoTQPPolicyEndpoint::bound($this->getApi());
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
   * @param string $startSpend
   * @param string $maxSpend
   * @param int    $startPercentage
   * @param int    $maxPercentage
   * @param string $triggerAction
   * @param string $resetAction
   * @param string $level
   *
   * @return FortifiApiRequestInterface|CreateAffiliateAutoTQPPolicyResponse
   */
  public function create(
    $companyFid, $resourceFid, $campaignHash,
    $sid1, $sid2, $sid3, $action, $country, $platform, $description,
    $startSpend, $maxSpend, $startPercentage, $maxPercentage,
    $triggerAction, $resetAction, $level
  )
  {
    $payload = new CreateAffiliateAutoTQPPolicyPayload();
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
    $payload->startSpend = $startSpend;
    $payload->maxSpend = $maxSpend;
    $payload->startPercentage = $startPercentage;
    $payload->maxPercentage = $maxPercentage;
    $payload->triggerAction = $triggerAction;
    $payload->resetAction = $resetAction;
    $payload->level = $level;

    $ep = AffiliateAutoTQPPolicyEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $description
   * @param string $startSpend
   * @param string $maxSpend
   * @param int    $startPercentage
   * @param int    $maxPercentage
   * @param string $triggerAction
   * @param string $resetAction
   * @param string $level
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update(
    $fid, $description,
    $startSpend, $maxSpend, $startPercentage, $maxPercentage,
    $triggerAction, $resetAction, $level
  )
  {
    $payload = new UpdateAffiliateAutoTQPPolicyPayload();
    $payload->fid = $fid;
    $payload->description = $description;
    $payload->startSpend = $startSpend;
    $payload->maxSpend = $maxSpend;
    $payload->startPercentage = $startPercentage;
    $payload->maxPercentage = $maxPercentage;
    $payload->triggerAction = $triggerAction;
    $payload->resetAction = $resetAction;
    $payload->level = $level;

    $ep = AffiliateAutoTQPPolicyEndpoint::bound($this->getApi());
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

    $ep = AffiliateAutoTQPPolicyEndpoint::bound($this->getApi());
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

    $ep = AffiliateAutoTQPPolicyEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }
}
