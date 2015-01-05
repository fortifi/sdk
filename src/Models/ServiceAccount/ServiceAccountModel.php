<?php
namespace Fortifi\FortifiCo\Applications\ServiceAccount\Models;

use Fortifi\FortifiApi\Auth\Payloads\CreateServiceAccountPayload;
use Fortifi\FortifiApi\Auth\Payloads\ServiceAccountNamePayload;
use Fortifi\FortifiApi\Auth\Payloads\ServiceAccountPayload;
use Fortifi\FortifiApi\Auth\Responses\ServiceAccountResponse;
use Fortifi\FortifiApi\Auth\Endpoints\ServiceAccountEndpoint;
use Fortifi\FortifiApi\Auth\Responses\ServiceAccountsResponse;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedPayload;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class ServiceAccountModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param string $filter
   *
   * @return ServiceAccountsResponse
   */
  public function all(
    $limit = null, $page = null, $sortField = null, $sortDirection = null,
    $filter = null
  )
  {
    $payload                = new PaginatedPayload();
    $payload->limit         = $limit;
    $payload->page          = $page;
    $payload->sortField     = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->filter        = $filter;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param int $fid
   *
   * @return ServiceAccountResponse
   */
  public function retrieve($fid)
  {
    $payload      = new ServiceAccountPayload();
    $payload->fid = $fid;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $name
   *
   * @return ServiceAccountResponse
   */
  public function create($name)
  {
    $payload       = new CreateServiceAccountPayload();
    $payload->name = $name;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return ServiceAccountResponse
   */
  public function delete($fid)
  {
    $payload      = new ServiceAccountPayload();
    $payload->fid = $fid;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return ServiceAccountResponse
   */
  public function enable($fid)
  {
    $payload      = new ServiceAccountPayload();
    $payload->fid = $fid;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->enable($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return ServiceAccountResponse
   */
  public function disable($fid)
  {
    $payload      = new ServiceAccountPayload();
    $payload->fid = $fid;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->disable($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $name
   *
   * @return ServiceAccountResponse
   */
  public function setName($fid, $name)
  {
    $payload       = new ServiceAccountNamePayload();
    $payload->fid  = $fid;
    $payload->name = $name;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->setName($payload)->get();
  }
}
