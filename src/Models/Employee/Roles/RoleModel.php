<?php
namespace Fortifi\Sdk\Models\Employee\Roles;

use Fortifi\FortifiApi\Edge\Payloads\EdgePayload;
use Fortifi\FortifiApi\Employee\Endpoints\EmployeeRoleEndpoint;
use Fortifi\FortifiApi\Employee\Payloads\Roles\CreateEmployeeRolePayload;
use Fortifi\FortifiApi\Employee\Payloads\Roles\EmployeeRolePaginatedPayload;
use Fortifi\FortifiApi\Employee\Payloads\Roles\EmployeeRolePayload;
use Fortifi\FortifiApi\Employee\Payloads\Roles\RoleEmployeesPayload;
use Fortifi\FortifiApi\Employee\Payloads\Roles\UpdateEmployeeRolePayload;
use Fortifi\FortifiApi\Employee\Payloads\SetPermissionPayload;
use Fortifi\FortifiApi\Employee\Responses\EmployeesResponse;
use Fortifi\FortifiApi\Employee\Responses\Roles\EmployeeRoleResponse;
use Fortifi\FortifiApi\Employee\Responses\Roles\EmployeeRolesResponse;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Foundation\Responses\FidsResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class RoleModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return EmployeeRolesResponse|FortifiApiRequestInterface
   */
  public function all(
    $limit = null, $page = null, $sortField = null, $sortDirection = null,
    $showDeleted = false, $filter = null
  )
  {
    $payload = new EmployeeRolePaginatedPayload();
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted = $showDeleted;
    $payload->filter = $filter;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return EmployeeRoleResponse|FortifiApiRequestInterface
   */
  public function retrieve($fid)
  {
    $payload = new EmployeeRolePayload();
    $payload->fid = $fid;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $name
   * @param string $description
   *
   * @return EmployeeRoleResponse|FortifiApiRequestInterface
   */
  public function create($name, $description)
  {
    $payload = new CreateEmployeeRolePayload();
    $payload->name = $name;
    $payload->description = $description;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $name
   * @param string $description
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($fid, $name, $description)
  {
    $payload = new UpdateEmployeeRolePayload();
    $payload->fid = $fid;
    $payload->name = $name;
    $payload->description = $description;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function delete($fid)
  {
    $payload = new EmployeeRolePayload();
    $payload->fid = $fid;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());

    return $ep->delete($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function restore($fid)
  {
    $payload = new EmployeeRolePayload();
    $payload->fid = $fid;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }

  /**
   * @param string $fid
   * @param array  $addPermissions
   * @param array  $removePermissions
   * @param array  $replacePermissions
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setPermissions(
    $fid, array $addPermissions = [], array $removePermissions = [],
    array $replacePermissions = []
  )
  {
    $payload = new SetPermissionPayload();
    $payload->fid = $fid;
    $payload->addPermissions = $addPermissions;
    $payload->removePermissions = $removePermissions;
    $payload->replacePermissions = $replacePermissions;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->setPermissions($payload)->get();
  }

  /**
   * @param string $roleFid
   * @param        $items
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function addEmployees($roleFid, $items)
  {
    $payload = new RoleEmployeesPayload();
    $payload->roleFid = $roleFid;
    $payload->items = $items;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->addEmployees($payload)->get();
  }

  /**
   * @param string $roleFid
   * @param        $items
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function removeEmployees($roleFid, $items)
  {
    $payload = new RoleEmployeesPayload();
    $payload->roleFid = $roleFid;
    $payload->items = $items;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->removeEmployees($payload)->get();
  }

  /**
   * @param string $fid
   * @param bool   $loadRefs
   *
   * @return EmployeesResponse|FortifiApiRequestInterface|FidsResponse
   */
  public function getEmployees($fid, $loadRefs = false)
  {
    $payload = new EdgePayload();
    $payload->fid = $fid;
    $payload->loadRefs = $loadRefs;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->getEmployees($payload)->get();
  }
}
