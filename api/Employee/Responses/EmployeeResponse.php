<?php
namespace Fortifi\FortifiApi\Employee\Responses;

use Fortifi\FortifiApi\Auth\Responses\AuthUserResponse;
use Fortifi\FortifiApi\Contact\Responses\EmailResponse;
use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;
use Packaged\Helpers\ValueAs;

class EmployeeResponse extends DataNodeResponse
{
  public $userFid;
  public $position;
  public $title;
  public $firstName;
  public $middleNames;
  public $lastName;
  public $emailFid;
  public $isDisabled;
  /**
   * @gotype int64
   */
  public $permissions;
  public $isAdmin;
  /**
   * @gotype int64
   */
  public $mfaLevel;

  /**
   * @var AuthUserResponse
   */
  public $user;
  /**
   * @var EmailResponse
   */
  public $emailData;
  public $email;

  public function hydrate($data)
  {
    parent::hydrate($data);
    if(!empty($this->user))
    {
      $this->user = AuthUserResponse::make($this->user);
    }
    if(!empty($this->emailData))
    {
      $this->emailData = EmailResponse::make($this->emailData);
    }
  }

  public function getDisplayText()
  {
    return ValueAs::nonempty(
      $this->displayName,
      implode(' ', array_filter([$this->firstName, $this->lastName])),
      'Employee'
    );
  }
}
