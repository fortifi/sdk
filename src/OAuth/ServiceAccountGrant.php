<?php
namespace Fortifi\Sdk\OAuth;

use League\OAuth2\Client\Grant\GrantInterface;

class ServiceAccountGrant implements GrantInterface
{
  protected $_apiKey;
  protected $_apiUser;

  public function __construct($user, $key)
  {
    $this->_apiUser = $user;
    $this->_apiKey = $key;
  }

  public function __toString()
  {
    return 'service_account';
  }

  public function prepRequestParams($defaultParams, $params)
  {
    $params['grant_type'] = 'service_account';
    $params['api_user'] = $this->_apiUser;
    $params['api_key'] = $this->_apiKey;

    return array_merge($defaultParams, $params);
  }

  public function handleResponse($response = [])
  {
    return new FortifiAccessToken($response);
  }
}
