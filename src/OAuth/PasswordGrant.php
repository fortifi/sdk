<?php
namespace Fortifi\Sdk\OAuth;

use League\OAuth2\Client\Grant\Password;

class PasswordGrant extends Password implements FortifiGrant
{
  public function handleResponse($response = [])
  {
    return new FortifiAccessToken($response);
  }
}
