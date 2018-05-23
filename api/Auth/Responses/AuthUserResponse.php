<?php
namespace Fortifi\FortifiApi\Auth\Responses;

use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class AuthUserResponse extends DataNodeResponse
{
  public $username;
  public $timezone;
  public $language;
  public $apiKey;
  public $secret;
  public $isSystemAgent;
  public $isServiceAccount;
  public $userType;
  public $isApproved;
  public $isDisabled;
  public $mfaLevel;
}
