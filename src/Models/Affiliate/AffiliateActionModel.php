<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateActionEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\CreateAffiliateActionPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\ListAffiliateActionPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\SetKeyAffiliateActionPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\SetTypeAffiliateActionPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\UpdateAffiliateActionPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Action\AffiliateActionResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Action\AffiliateActionsResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Action\CreateAffiliateActionResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateActionModel extends FortifiApiModel
{
  /**
   * @param string $companyFid
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return AffiliateActionsResponse|FortifiApiRequestInterface
   */
  public function all($companyFid,
    $limit = 10, $page = 1, $sortField = null,
    $sortDirection = null, $showDeleted = false, $filter = null
  )
  {
    $payload = new ListAffiliateActionPayload();
    $payload->companyFid = $companyFid;
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted = $showDeleted;
    $payload->filter = $filter;

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
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateActionEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $companyFid
   * @param string $displayName
   * @param string $key
   * @param string $description
   * @param int    $type
   * @param string $approvalType
   * @param int    $approvalDays
   * @param string $maxCommission
   * @param string $url
   * @param int    $redirectCode
   * @param string $lookupUrl
   *
   * @return FortifiApiRequestInterface|CreateAffiliateActionResponse
   */
  public function create(
    $companyFid, $displayName, $key, $description, $type,
    $approvalType, $approvalDays, $maxCommission, $url,
    $redirectCode, $lookupUrl
  )
  {
    $payload = new CreateAffiliateActionPayload();
    $payload->companyFid = $companyFid;
    $payload->displayName = $displayName;
    $payload->key = $key;
    $payload->description = $description;
    $payload->type = $type;
    $payload->approvalType = is_null($approvalType) ? '' : $approvalType;
    $payload->approvalDays = $approvalDays;
    $payload->maxCommission = $maxCommission;
    $payload->url = $url;
    $payload->redirectCode = $redirectCode;
    $payload->lookupUrl = $lookupUrl;

    $ep = AffiliateActionEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $displayName
   * @param string $description
   * @param string $approvalType
   * @param int    $approvalDays
   * @param string $maxCommission
   * @param string $url
   * @param int    $redirectCode
   * @param string $lookupUrl
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update(
    $fid, $displayName, $description, $approvalType,
    $approvalDays, $maxCommission, $url, $redirectCode,
    $lookupUrl
  )
  {
    $payload = new UpdateAffiliateActionPayload();
    $payload->fid = $fid;
    $payload->displayName = $displayName;
    $payload->description = $description;
    $payload->approvalType = $approvalType;
    $payload->approvalDays = $approvalDays;
    $payload->maxCommission = $maxCommission;
    $payload->url = $url;
    $payload->redirectCode = $redirectCode;
    $payload->lookupUrl = $lookupUrl;

    $ep = AffiliateActionEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function delete($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateActionEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $type
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setType($fid, $type)
  {
    $payload = new SetTypeAffiliateActionPayload();
    $payload->fid = $fid;
    $payload->type = $type;

    $ep = AffiliateActionEndpoint::bound($this->getApi());
    return $ep->setType($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $key
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setKey($fid, $key)
  {
    $payload = new SetKeyAffiliateActionPayload();
    $payload->fid = $fid;
    $payload->key = $key;

    $ep = AffiliateActionEndpoint::bound($this->getApi());
    return $ep->setKey($payload)->get();
  }
}
