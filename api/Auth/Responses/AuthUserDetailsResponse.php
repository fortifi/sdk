<?php
namespace Fortifi\FortifiApi\Auth\Responses;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class AuthUserDetailsResponse extends FortifiApiResponse
{
  public $userFid;
  public $avatarUrl;
  public $authedFid;
  public $language;
  public $timezone;
  public $username;
  public $isApproved;
  public $isDisabled;
  public $userType;
  public $displayName;
  public $firstName;
  public $lastName;
  public $description;
  public $permissions;
  public $roles;
  public $departments;
  public $companies;
  public $secret;
  public $email;
  public $languagesSpoken;
}
