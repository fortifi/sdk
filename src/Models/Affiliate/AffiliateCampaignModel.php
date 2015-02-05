<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateCampaignEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Campaign\CreateAffiliateCampaignPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Campaign\UpdateAffiliateCampaignPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Campaign\AffiliateCampaignResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Campaign\AffiliateCampaignsResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Campaign\CreateAffiliateCampaignResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateCampaignModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return AffiliateCampaignsResponse|FortifiApiRequestInterface
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

    $ep = AffiliateCampaignEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AffiliateCampaignResponse|FortifiApiRequestInterface
   */
  public function retrieve($fid)
  {
    $payload      = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateCampaignEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $affiliateFid
   * @param string $companyFid
   * @param string $name
   * @param string $options
   *
   * @return FortifiApiRequestInterface|CreateAffiliateCampaignResponse
   */
  public function create($affiliateFid, $companyFid, $name, $options)
  {
    $payload               = new CreateAffiliateCampaignPayload();
    $payload->affiliateFid = $affiliateFid;
    $payload->companyFid   = $companyFid;
    $payload->name         = $name;
    $payload->options      = $options;

    $ep = AffiliateCampaignEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $name
   * @param string $options
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($fid, $name, $options)
  {
    $payload          = new UpdateAffiliateCampaignPayload();
    $payload->fid     = $fid;
    $payload->name    = $name;
    $payload->options = $options;

    $ep = AffiliateCampaignEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }
}
