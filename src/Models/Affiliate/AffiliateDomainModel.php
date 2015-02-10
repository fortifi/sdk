<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateDomainEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Domains\AffiliateDomainPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Domains\RetrieveAffiliateDomainPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Domains\AffiliateDomainResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Domains\AffiliateDomainsResponse;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateDomainModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return AffiliateDomainsResponse|FortifiApiRequestInterface
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

    $ep = AffiliateDomainEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $domain
   *
   * @return AffiliateDomainResponse|FortifiApiRequestInterface
   */
  public function retrieve($domain)
  {
    $payload         = new RetrieveAffiliateDomainPayload();
    $payload->domain = $domain;

    $ep = AffiliateDomainEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $domain
   * @param string $affiliateFid
   * @param string $campaignHash
   * @param string $sid1
   * @param string $sid2
   * @param string $sid3
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function create($domain, $affiliateFid, $campaignHash,
    $sid1, $sid2, $sid3
  )
  {
    $payload               = new AffiliateDomainPayload();
    $payload->domain       = $domain;
    $payload->affiliateFid = $affiliateFid;
    $payload->campaignHash = $campaignHash;
    $payload->sid1         = $sid1;
    $payload->sid2         = $sid2;
    $payload->sid3         = $sid3;

    $ep = AffiliateDomainEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $domain
   * @param string $affiliateFid
   * @param string $campaignHash
   * @param string $sid1
   * @param string $sid2
   * @param string $sid3
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($domain, $affiliateFid, $campaignHash,
    $sid1, $sid2, $sid3
  )
  {
    $payload                   = new AffiliateDomainPayload();
    $payload->domain       = $domain;
    $payload->affiliateFid = $affiliateFid;
    $payload->campaignHash = $campaignHash;
    $payload->sid1         = $sid1;
    $payload->sid2         = $sid2;
    $payload->sid3         = $sid3;

    $ep = AffiliateDomainEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }
}
