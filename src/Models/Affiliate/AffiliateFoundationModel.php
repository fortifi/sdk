<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateFoundationEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Foundation\CreateAffiliateFoundationPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Foundation\UpdateAffiliateFoundationPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Foundation\AffiliateFoundationResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Foundation\AffiliateFoundationsResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Foundation\CreateAffiliateFoundationResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateFoundationModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return AffiliateFoundationsResponse|FortifiApiRequestInterface
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

    $ep = AffiliateFoundationEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AffiliateFoundationResponse|FortifiApiRequestInterface
   */
  public function retrieve($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateFoundationEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $displayName
   * @param string $type
   *
   * @return FortifiApiRequestInterface|CreateAffiliateFoundationResponse
   */
  public function create($displayName, $type)
  {
    $payload = new CreateAffiliateFoundationPayload();
    $payload->displayName = $displayName;
    $payload->type = $type;

    $ep = AffiliateFoundationEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $displayName
   * @param string $type
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($fid, $displayName, $type)
  {
    $payload = new UpdateAffiliateFoundationPayload();
    $payload->fid = $fid;
    $payload->displayName = $displayName;
    $payload->type = $type;

    $ep = AffiliateFoundationEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }
}
