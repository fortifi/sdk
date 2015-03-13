<?php
namespace Fortifi\Sdk\OAuth;

use League\OAuth2\Client\Grant\RefreshToken;

class RefreshTokenGrant extends RefreshToken
{
  public function handleResponse($response = [])
  {
    return new AccessToken($response);
  }
}
