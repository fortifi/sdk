<?php
namespace Fortifi\Sdk\Models\Employee\Roles;

use Fortifi\FortifiApi\Edge\Payloads\EdgePayload;
use Fortifi\FortifiApi\Employee\Payloads\Roles\EmployeeRolePaginatedPayload;
use Fortifi\FortifiApi\Employee\Payloads\Roles\EmployeeRolePayload;
use Fortifi\FortifiApi\Employee\Payloads\Roles\CreateEmployeeRolePayload;
use Fortifi\FortifiApi\Employee\Payloads\Roles\RoleEmployeesPayload;
use Fortifi\FortifiApi\Employee\Payloads\Roles\UpdateEmployeeRolePayload;
use Fortifi\FortifiApi\Employee\Endpoints\EmployeeRoleEndpoint;
use Fortifi\FortifiApi\Employee\Payloads\SetPermissionPayload;
use Fortifi\FortifiApi\Employee\Responses\Roles\EmployeeRoleResponse;
use Fortifi\FortifiApi\Employee\Responses\Roles\EmployeeRolesResponse;
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
   * @return EmployeeRolesResponse
   */
  public function all(
    $limit = null, $page = null, $sortField = null, $sortDirection = null,
    $showDeleted = false, $filter = null
  )
  {
    $payload                = new EmployeeRolePaginatedPayload();
    $payload->limit         = $limit;
    $payload->page          = $page;
    $payload->sortField     = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted   = $showDeleted;
    $payload->filter        = $filter;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param $fid
   *
   * @return EmployeeRoleResponse
   */
  public function retrieve($fid)
  {
    $payload      = new EmployeeRolePayload();
    $payload->fid = $fid;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param $name
   * @param $description
   *
   * @return \Packaged\Api\Interfaces\ApiResponseInterface
   */
  public function create($name, $description)
  {
    $payload              = new CreateEmployeeRolePayload();
    $payload->name        = $name;
    $payload->description = $description;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param $fid
   * @param $name
   * @param $description
   *
   * @return \Packaged\Api\Interfaces\ApiResponseInterface
   */
  public function update($fid, $name, $description)
  {
    $payload              = new UpdateEmployeeRolePayload();
    $payload->fid         = $fid;
    $payload->name        = $name;
    $payload->description = $description;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param $fid
   *
   * @return \Packaged\Api\Interfaces\ApiResponseInterface
   */
  public function delete($fid)
  {
    $payload      = new EmployeeRolePayload();
    $payload->fid = $fid;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());

    return $ep->delete($payload)->get();
  }

  /**
   * @param $fid
   *
   * @return \Packaged\Api\Interfaces\ApiResponseInterface
   */
  public function restore($fid)
  {
    $payload      = new EmployeeRolePayload();
    $payload->fid = $fid;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }

  /**
   * @param       $fid
   * @param array $addPermissions
   * @param array $removePermissions
   * @param array $replacePermissions
   *
   * @return $this
   */
  public function setPermissions(
    $fid, array $addPermissions = [], array $removePermissions = [],
    array $replacePermissions = []
  )
  {
    $payload                      = new SetPermissionPayload();
    $payload->fid                 = $fid;
    $payload->addPermissions      = $addPermissions;
    $payload->removePermissions   = $removePermissions;
    $payload->replacePermissions  = $replacePermissions;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->setPermissions($payload)->get();
  }

  /**
   * @param $roleFid
   * @param $items
   *
   * @return mixed
   */
  public function addEmployees($roleFid, $items)
  {
    $payload          = new RoleEmployeesPayload();
    $payload->roleFid = $roleFid;
    $payload->items   = $items;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->addEmployees($payload)->get();
  }

  /**
   * @param $roleFid
   * @param $items
   *
   * @return mixed
   */
  public function removeEmployees($roleFid, $items)
  {
    $payload          = new RoleEmployeesPayload();
    $payload->roleFid = $roleFid;
    $payload->items   = $items;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->removeEmployees($payload)->get();
  }

  /**
   * @param $roleFid
   * @param $items
   *
   * @return $this
   */
  public function replaceEmployees($roleFid, $items)
  {
    $payload          = new RoleEmployeesPayload();
    $payload->roleFid = $roleFid;
    $payload->items   = $items;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->replaceEmployees($payload)->get();
  }

  /**
   * @param $fid
   * @param $loadRefs
   *
   * @return $this
   */
  public function getEmployees($fid, $loadRefs = false)
  {
    $payload           = new EdgePayload();
    $payload->fid      = $fid;
    $payload->loadRefs = $loadRefs;

    $ep = EmployeeRoleEndpoint::bound($this->getApi());
    return $ep->getEmployees($payload)->get();
  }
}
