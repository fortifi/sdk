<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateActionEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\CreateAffiliateActionPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\UpdateAffiliateActionPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Action\AffiliateActionResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Action\AffiliateActionsResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Action\CreateAffiliateActionResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateActionModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return AffiliateActionsResponse|FortifiApiRequestInterface
   */
  public function all($limit = 10, $page = 1, $sortField = null,
    $sortDirection = null, $showDeleted = false, $filter = null
  )
  {
    $payload                = new PaginatedDataNodePayload();
    $payload->limit         = $limit;
    $payload->page          = $page;
    $payload->sortField     = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted   = $showDeleted;
    $payload->filter        = $filter;

    $ep = AffiliateActionEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AffiliateActionResponse|FortifiApiRequestInterface
   */
  public function retrieve($fid)
  {
    $payload      = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateActionEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $companyFid
   * @param string $key
   * @param string $name
   * @param string $description
   * @param string $type
   * @param string $approvalType
   * @param int    $approvalDays
   * @param string $maxCommission
   * @param string $url
   * @param int    $redirectCode
   *
   * @return FortifiApiRequestInterface|CreateAffiliateActionResponse
   */
  public function create($companyFid, $key, $name, $description, $type,
    $approvalType, $approvalDays, $maxCommission, $url, $redirectCode
  )
  {
    $payload                = new CreateAffiliateActionPayload();
    $payload->companyFid    = $companyFid;
    $payload->key           = $key;
    $payload->name          = $name;
    $payload->description   = $description;
    $payload->type          = $type;
    $payload->approvalType  = $approvalType;
    $payload->approvalDays  = $approvalDays;
    $payload->maxCommission = $maxCommission;
    $payload->url           = $url;
    $payload->redirectCode  = $redirectCode;

    $ep = AffiliateActionEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $name
   * @param string $description
   * @param string $type
   * @param string $approvalType
   * @param int    $approvalDays
   * @param string $maxCommission
   * @param string $url
   * @param int    $redirectCode
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($fid, $name, $description, $type,
    $approvalType, $approvalDays, $maxCommission, $url, $redirectCode
  )
  {
    $payload                = new UpdateAffiliateActionPayload();
    $payload->fid           = $fid;
    $payload->name          = $name;
    $payload->description   = $description;
    $payload->type          = $type;
    $payload->approvalType  = $approvalType;
    $payload->approvalDays  = $approvalDays;
    $payload->maxCommission = $maxCommission;
    $payload->url           = $url;
    $payload->redirectCode  = $redirectCode;

    $ep = AffiliateActionEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }
}
