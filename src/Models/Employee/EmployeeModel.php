<?php
namespace Fortifi\Sdk\Models\Employee;

use Fortifi\FortifiApi\Company\Responses\CompaniesResponse;
use Fortifi\FortifiApi\Edge\Payloads\EdgePayload;
use Fortifi\FortifiApi\Employee\Endpoints\EmployeeEndpoint;
use Fortifi\FortifiApi\Employee\Payloads\CreateEmployeePayload;
use Fortifi\FortifiApi\Employee\Payloads\EmployeeCompaniesPayload;
use Fortifi\FortifiApi\Employee\Payloads\EmployeeEmailFidPayload;
use Fortifi\FortifiApi\Employee\Payloads\EmployeeEmailPayload;
use Fortifi\FortifiApi\Employee\Payloads\EmployeePaginatedPayload;
use Fortifi\FortifiApi\Employee\Payloads\EmployeePayload;
use Fortifi\FortifiApi\Employee\Payloads\EmployeeProfilePayload;
use Fortifi\FortifiApi\Employee\Payloads\EmployeeRolesPayload;
use Fortifi\FortifiApi\Employee\Payloads\SetEmployeeAdminPayload;
use Fortifi\FortifiApi\Employee\Payloads\SetPermissionPayload;
use Fortifi\FortifiApi\Employee\Responses\CreateEmployeeResponse;
use Fortifi\FortifiApi\Employee\Responses\EmployeeResponse;
use Fortifi\FortifiApi\Employee\Responses\EmployeesResponse;
use Fortifi\FortifiApi\Employee\Responses\Roles\EmployeeRolesResponse;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Foundation\Responses\FidsResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class EmployeeModel extends FortifiApiModel
{
  /**
   * @param null   $limit
   * @param null   $page
   * @param null   $sortField
   * @param null   $sortDirection
   * @param int    $showDeleted
   * @param int    $showDisabled
   * @param string $filter
   *
   * @return FortifiApiRequestInterface|EmployeesResponse
   */
  public function all(
    $limit = null, $page = null, $sortField = null, $sortDirection = null,
    $showDeleted = 0, $showDisabled = 1, $filter = null
  )
  {
    $payload                = new EmployeePaginatedPayload();
    $payload->limit         = $limit;
    $payload->page          = $page;
    $payload->sortField     = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted   = $showDeleted;
    $payload->showDisabled  = $showDisabled;
    $payload->filter        = $filter;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param int $fid
   *
   * @return FortifiApiRequestInterface|EmployeeResponse
   */
  public function retrieve($fid)
  {
    $payload = EmployeePayload::create($fid);

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $username
   * @param string $firstName
   * @param string $lastName
   * @param string $email
   * @param string $password
   * @param bool   $isAdmin
   *
   * @return FortifiApiRequestInterface|CreateEmployeeResponse
   */
  public function create(
    $username, $firstName, $lastName, $email, $password, $isAdmin = false
  )
  {
    $payload            = new CreateEmployeePayload();
    $payload->username  = $username;
    $payload->firstName = $firstName;
    $payload->lastName  = $lastName;
    $payload->email     = $email;
    $payload->isAdmin   = $isAdmin;
    $payload->password  = $password;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param int    $fid
   * @param string $firstName
   * @param string $lastName
   * @param string $middleNames
   * @param string $displayName
   * @param string $title
   * @param string $position
   * @param string $description
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update(
    $fid, $firstName, $lastName, $middleNames, $displayName, $title, $position,
    $description
  )
  {
    $payload              = new EmployeeProfilePayload();
    $payload->fid         = $fid;
    $payload->firstName   = $firstName;
    $payload->lastName    = $lastName;
    $payload->middleNames = $middleNames;
    $payload->displayName = $displayName;
    $payload->title       = $title;
    $payload->position    = $position;
    $payload->description = $description;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param int $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function disable($fid)
  {
    $payload = EmployeePayload::create($fid);

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->disable($payload)->get();
  }

  /**
   * @param int $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function enable($fid)
  {
    $payload = EmployeePayload::create($fid);

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->enable($payload)->get();
  }

  /**
   * @param int $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function delete($fid)
  {
    $payload = EmployeePayload::create($fid);

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param int $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function restore($fid)
  {
    $payload = EmployeePayload::create($fid);

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }

  /**
   * @param       $fid
   * @param array $addPermissions
   * @param array $removePermissions
   * @param array $replacePermissions
   *
   * @return FortifiApiRequestInterface|BoolResponse
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

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->setPermissions($payload)->get();
  }

  /**
   * @param $fid
   * @param $items
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function addCompanies($fid, $items)
  {
    $payload = new EmployeeCompaniesPayload();
    $payload->employeeFid = $fid;
    $payload->items = $items;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->addCompanies($payload)->get();
  }

  /**
   * @param $fid
   * @param $items
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function removeCompanies($fid, $items)
  {
    $payload = new EmployeeCompaniesPayload();
    $payload->employeeFid = $fid;
    $payload->items = $items;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->removeCompanies($payload)->get();
  }

  /**
   * @param $fid
   * @param $items
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function replaceCompanies($fid, $items)
  {
    $payload = new EmployeeCompaniesPayload();
    $payload->employeeFid = $fid;
    $payload->items = $items;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->replaceCompanies($payload)->get();
  }

  /**
   * @param $fid
   *
   * @return FortifiApiRequestInterface|FidsResponse|CompaniesResponse
   */
  public function getCompanies($fid)
  {
    $payload        = new EdgePayload();
    $payload->fid  = $fid;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->getCompanies($payload)->get();
  }

  /**
   * @param $fid
   * @param $items
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function addRoles($fid, $items)
  {
    $payload = new EmployeeRolesPayload();
    $payload->employeeFid = $fid;
    $payload->items       = $items;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->addRoles($payload)->get();
  }

  /**
   * @param $fid
   * @param $items
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function removeRoles($fid, $items)
  {
    $payload = new EmployeeRolesPayload();
    $payload->employeeFid = $fid;
    $payload->items       = $items;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->removeRoles($payload)->get();
  }

  /**
   * @param $fid
   * @param $items
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function replaceRoles($fid, $items)
  {
    $payload = new EmployeeRolesPayload();
    $payload->employeeFid = $fid;
    $payload->items       = $items;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->replaceRoles($payload)->get();
  }

  /**
   * @param $fid
   *
   * @return FortifiApiRequestInterface|FidsResponse|EmployeeRolesResponse
   */
  public function getRoles($fid)
  {
    $payload       = new EdgePayload();
    $payload->fid  = $fid;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->getRoles($payload)->get();
  }

  /**
   * @param      $fid
   * @param bool $isAdmin
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setAdmin($fid, $isAdmin)
  {
    $payload          = new SetEmployeeAdminPayload();
    $payload->fid     = $fid;
    $payload->isAdmin = $isAdmin;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->setAdmin($payload)->get();
  }

  /**
   * @param $fid
   * @param $email
   * @param $setAsDefault
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function addEmail($fid, $email, $setAsDefault)
  {
    $payload                = new EmployeeEmailPayload();
    $payload->fid           = $fid;
    $payload->email         = $email;
    $payload->setAsDefault  = $setAsDefault;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->addEmail($payload)->get();
  }

  /**
   * @param $fid
   * @param $emailFid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function removeEmail($fid, $emailFid)
  {
    $payload            = new EmployeeEmailFidPayload();
    $payload->fid       = $fid;
    $payload->emailFid  = $emailFid;

    $ep = EmployeeEndpoint::bound($this->getApi());
    return $ep->removeEmail($payload)->get();
  }
}
