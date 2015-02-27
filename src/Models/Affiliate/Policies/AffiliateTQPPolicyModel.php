<?php
namespace Fortifi\Sdk\Models\Affiliate\Policies;

use Fortifi\FortifiApi\Affiliate\Endpoints\Policies\AffiliateTQPPolicyEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\TQP\CreateAffiliateTQPPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Policies\TQP\UpdateAffiliateTQPPolicyPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\TQP\AffiliateTQPPoliciesResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\TQP\AffiliateTQPPolicyResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Policies\TQP\CreateAffiliateTQPPolicyResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateTQPPolicyModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return AffiliateTQPPoliciesResponse|FortifiApiRequestInterface
   */
  public function all(
    $limit = 10, $page = 1, $sortField = null,
    $sortDirection = null, $showDeleted = false, $filter = null
  )
  {
    $payload = new PaginatedDataNodePayload();
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted = $showDeleted;
    $payload->filter = $filter;

    $ep = AffiliateTQPPolicyEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AffiliateTQPPolicyResponse|FortifiApiRequestInterface
   */
  public function retrieve($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateTQPPolicyEndpoint::bound($this->getApi());
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
   * @param int    $acceptPercentage
   *
   * @return FortifiApiRequestInterface|CreateAffiliateTQPPolicyResponse
   */
  public function create(
    $companyFid, $resourceFid, $campaignHash,
    $sid1, $sid2, $sid3, $action, $country, $platform, $description,
    $acceptPercentage
  )
  {
    $payload = new CreateAffiliateTQPPolicyPayload();
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
    $payload->acceptPercentage = $acceptPercentage;

    $ep = AffiliateTQPPolicyEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $description
   * @param int    $acceptPercentage
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($fid, $description, $acceptPercentage)
  {
    $payload = new UpdateAffiliateTQPPolicyPayload();
    $payload->fid = $fid;
    $payload->description = $description;
    $payload->acceptPercentage = $acceptPercentage;

    $ep = AffiliateTQPPolicyEndpoint::bound($this->getApi());
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

    $ep = AffiliateTQPPolicyEndpoint::bound($this->getApi());
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

    $ep = AffiliateTQPPolicyEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }
}
