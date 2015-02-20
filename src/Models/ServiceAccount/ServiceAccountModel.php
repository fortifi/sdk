<?php
namespace Fortifi\Sdk\Models\ServiceAccount;

use Fortifi\FortifiApi\Auth\Endpoints\AuthEndpoint;
use Fortifi\FortifiApi\Auth\Endpoints\ServiceAccountEndpoint;
use Fortifi\FortifiApi\Auth\Payloads\CreateServiceAccountPayload;
use Fortifi\FortifiApi\Auth\Payloads\ServiceAccountNamePayload;
use Fortifi\FortifiApi\Auth\Payloads\ServiceAccountPayload;
use Fortifi\FortifiApi\Auth\Payloads\UserPayload;
use Fortifi\FortifiApi\Auth\Responses\ServiceAccountResponse;
use Fortifi\FortifiApi\Auth\Responses\ServiceAccountsResponse;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Foundation\Responses\StringResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class ServiceAccountModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return ServiceAccountsResponse|FortifiApiRequestInterface
   */
  public function all(
    $limit = null, $page = null, $sortField = null, $sortDirection = null,
    $showDeleted = false, $filter = null
  )
  {
    $payload = new PaginatedDataNodePayload();
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted = $showDeleted;
    $payload->filter = $filter;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return ServiceAccountResponse|FortifiApiRequestInterface
   */
  public function retrieve($fid)
  {
    $payload = new ServiceAccountPayload();
    $payload->fid = $fid;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $name
   *
   * @return ServiceAccountResponse|FortifiApiRequestInterface
   */
  public function create($name)
  {
    $payload = new CreateServiceAccountPayload();
    $payload->name = $name;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function delete($fid)
  {
    $payload = new ServiceAccountPayload();
    $payload->fid = $fid;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function enable($fid)
  {
    $payload = new ServiceAccountPayload();
    $payload->fid = $fid;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->enable($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function disable($fid)
  {
    $payload = new ServiceAccountPayload();
    $payload->fid = $fid;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->disable($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $name
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setName($fid, $name)
  {
    $payload = new ServiceAccountNamePayload();
    $payload->fid = $fid;
    $payload->name = $name;

    $ep = ServiceAccountEndpoint::bound($this->getApi());
    return $ep->setName($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|StringResponse
   */
  public function regenerateApiKey($fid)
  {
    $payload = new UserPayload();
    $payload->fid = $fid;

    $ep = AuthEndpoint::bound($this->getApi());
    return $ep->regenerateApiKey($payload)->get();
  }
}
