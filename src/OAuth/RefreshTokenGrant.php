<?php
namespace Fortifi\Sdk\OAuth;

use League\OAuth2\Client\Grant\RefreshToken;

class RefreshTokenGrant extends RefreshToken implements FortifiGrant
{
  public function handleResponse($response = [])
  {
    return new FortifiAccessToken($response);
  }
}
