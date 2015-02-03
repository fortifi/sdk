<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\CreateAffiliatePayload;
use Fortifi\FortifiApi\Affiliate\Payloads\UpdateAffiliatePayload;
use Fortifi\FortifiApi\Affiliate\Responses\AffiliateResponse;
use Fortifi\FortifiApi\Affiliate\Responses\AffiliatesResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Foundation\Responses\FidResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return AffiliatesResponse|FortifiApiRequestInterface
   */
  public function all($limit = null, $page = null,
    $sortField = null, $sortDirection = null,
    $showDeleted = false, $filter = null
  )
  {
    $payload                = new PaginatedDataNodePayload();
    $payload->limit         = $limit;
    $payload->page          = $page;
    $payload->sortField     = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted   = $showDeleted;
    $payload->filter        = $filter;

    $ep = AffiliateEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AffiliateResponse|FortifiApiRequestInterface
   */
  public function retrieve($fid)
  {
    $payload      = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $type
   * @param string $displayName
   * @param string $name
   * @param string $phone
   * @param string $email
   * @param string $website
   * @param bool   $acceptedTerms
   * @param bool   $suspended
   * @param string $accountManagerFid
   *
   * @return FortifiApiRequestInterface|FidResponse
   */
  public function create($type, $displayName,
    $name, $phone, $email, $website, $acceptedTerms = false,
    $suspended = false, $accountManagerFid
  )
  {
    $payload                    = new CreateAffiliatePayload();
    $payload->type              = $type;
    $payload->displayName       = $displayName;
    $payload->name              = $name;
    $payload->phone             = $phone;
    $payload->email             = $email;
    $payload->website           = $website;
    $payload->acceptedTerms     = $acceptedTerms;
    $payload->suspended         = $suspended;
    $payload->accountManagerFid = $accountManagerFid;

    $ep = AffiliateEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $userFid
   * @param string $type
   * @param string $displayName
   * @param string $name
   * @param string $phone
   * @param string $email
   * @param string $website
   * @param bool   $acceptedTerms
   * @param bool   $suspended
   * @param string $accountManagerFid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($fid, $userFid, $type, $displayName,
    $name, $phone, $email, $website, $acceptedTerms = false,
    $suspended = false, $accountManagerFid
  )
  {
    $payload                    = new UpdateAffiliatePayload();
    $payload->fid               = $fid;
    $payload->userFid           = $userFid;
    $payload->type              = $type;
    $payload->displayName       = $displayName;
    $payload->name              = $name;
    $payload->phone             = $phone;
    $payload->email             = $email;
    $payload->website           = $website;
    $payload->acceptedTerms     = $acceptedTerms;
    $payload->suspended         = $suspended;
    $payload->accountManagerFid = $accountManagerFid;

    $ep = AffiliateEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function delete($fid)
  {
    $payload      = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function restore($fid)
  {
    $payload      = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }

}
