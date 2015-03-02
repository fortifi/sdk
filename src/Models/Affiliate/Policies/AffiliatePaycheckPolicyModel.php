<?php
namespace Fortifi\Sdk\Models\Affiliate\Policies;

use Fortifi\FortifiApi\Affiliate\Endpoints\Policies\AffiliatePaycheckPolicyEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\ListAffiliatePolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\Paycheck\CreateAffiliatePaycheckPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\Paycheck\UpdateAffiliatePaycheckPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\Paycheck\AffiliatePaycheckPoliciesResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\Paycheck\AffiliatePaycheckPolicyResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\Paycheck\CreateAffiliatePaycheckPolicyResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliatePaycheckPolicyModel extends FortifiApiModel
{
  /**
   * @param string $companyFid;
   * @param string $affiliateFid;
   * @param string $foundationFid;
   *
   * @return AffiliatePaycheckPoliciesResponse|FortifiApiRequestInterface
   */
  public function all(
    $companyFid = null, $affiliateFid = null, $foundationFid = null
  )
  {
    $payload = new ListAffiliatePolicyPayload();
    $payload->companyFid = $companyFid;
    $payload->affiliateFid = $affiliateFid;
    $payload->foundationFid = $foundationFid;

    $ep = AffiliatePaycheckPolicyEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AffiliatePaycheckPolicyResponse|FortifiApiRequestInterface
   */
  public function retrieve($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliatePaycheckPolicyEndpoint::bound($this->getApi());
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
   * @param int    $minimumEarnings
   * @param int    $reservePercent
   * @param int    $reserveDays
   * @param string $frequency
   *
   * @return FortifiApiRequestInterface|CreateAffiliatePaycheckPolicyResponse
   */
  public function create(
    $companyFid, $resourceFid, $campaignHash,
    $sid1, $sid2, $sid3, $action, $country, $platform, $description,
    $minimumEarnings, $reservePercent, $reserveDays, $frequency
  )
  {
    $payload = new CreateAffiliatePaycheckPolicyPayload();
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
    $payload->minimumEarnings = $minimumEarnings;
    $payload->reservePercent = $reservePercent;
    $payload->reserveDays = $reserveDays;
    $payload->frequency = $frequency;

    $ep = AffiliatePaycheckPolicyEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $description
   * @param int    $minimumEarnings
   * @param int    $reservePercent
   * @param int    $reserveDays
   * @param string $frequency
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update(
    $fid, $description,
    $minimumEarnings, $reservePercent, $reserveDays, $frequency
  )
  {
    $payload = new UpdateAffiliatePaycheckPolicyPayload();
    $payload->fid = $fid;
    $payload->description = $description;
    $payload->minimumEarnings = $minimumEarnings;
    $payload->reservePercent = $reservePercent;
    $payload->reserveDays = $reserveDays;
    $payload->frequency = $frequency;

    $ep = AffiliatePaycheckPolicyEndpoint::bound($this->getApi());
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

    $ep = AffiliatePaycheckPolicyEndpoint::bound($this->getApi());
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

    $ep = AffiliatePaycheckPolicyEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }
}
