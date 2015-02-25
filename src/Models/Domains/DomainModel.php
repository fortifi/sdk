<?php
namespace Fortifi\Sdk\Models\Domains;

use Fortifi\FortifiApi\Domain\Endpoints\DomainEndpoint;
use Fortifi\FortifiApi\Domain\Payloads\CreateDomainPayload;
use Fortifi\FortifiApi\Domain\Payloads\DomainCompanyFidPayload;
use Fortifi\FortifiApi\Domain\Payloads\PaginatedDomainsByCompanyFidPayload;
use Fortifi\FortifiApi\Domain\Payloads\SetCookieDaysDomainPayload;
use Fortifi\FortifiApi\Domain\Payloads\UpdateDomainPayload;
use Fortifi\FortifiApi\Domain\Responses\DomainResponse;
use Fortifi\FortifiApi\Domain\Responses\DomainsResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Foundation\Responses\FidResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class DomainModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param int    $showDeleted
   * @param string $filter
   *
   * @return DomainsResponse
   */
  public function all(
    $limit = null, $page = null, $sortField = null, $sortDirection = null,
    $showDeleted = null, $filter = null
  )
  {
    $payload = new PaginatedDataNodePayload();
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted = $showDeleted;
    $payload->filter = $filter;

    $ep = DomainEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return DomainResponse
   */
  public function retrieve($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = DomainEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $domain
   * @param string $companyFid
   *
   * @return FidResponse
   */
  public function create($domain, $companyFid = null)
  {
    $payload = new CreateDomainPayload();
    $payload->domain = $domain;
    $payload->companyFid = $companyFid;

    $ep = DomainEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $domain
   *
   * @return BoolResponse
   */
  public function update($fid, $domain)
  {
    $payload = new UpdateDomainPayload();
    $payload->fid = $fid;
    $payload->domain = $domain;

    $ep = DomainEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return BoolResponse
   */
  public function delete($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = DomainEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return BoolResponse
   */
  public function verify($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = DomainEndpoint::bound($this->getApi());
    return $ep->verify($payload)->get();
  }

  /**
   * @param $fid
   * @param $companyFid
   *
   * @return BoolResponse
   */
  public function setCompany($fid, $companyFid)
  {
    $payload = new DomainCompanyFidPayload();
    $payload->fid = $fid;
    $payload->companyFid = $companyFid;

    $ep = DomainEndpoint::bound($this->getApi());
    return $ep->setCompany($payload)->get();
  }

  /**
   * @param $fid
   *
   * @return BoolResponse
   */
  public function unlinkCompany($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = DomainEndpoint::bound($this->getApi());
    return $ep->unlinkCompany($payload)->get();
  }

  /**
   * @param        $companyFid
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param int    $showDeleted
   * @param string $filter
   *
   * @return DomainsResponse
   */
  public function getByCompany(
    $companyFid, $limit = null, $page = null, $sortField = null,
    $sortDirection = null, $showDeleted = null, $filter = null
  )
  {
    $payload = new PaginatedDomainsByCompanyFidPayload();
    $payload->companyFid = $companyFid;
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted = $showDeleted;
    $payload->filter = $filter;

    $ep = DomainEndpoint::bound($this->getApi());
    return $ep->getByCompany($payload)->get();
  }

  /**
   * @param string $fid
   * @param int    $cookieDays
   *
   * @return BoolResponse
   */
  public function setCookieDays($fid, $cookieDays)
  {
    $payload = new SetCookieDaysDomainPayload();
    $payload->fid = $fid;
    $payload->cookieDays = $cookieDays;

    $ep = DomainEndpoint::bound($this->getApi());
    return $ep->setCookieDays($payload)->get();
  }
}
