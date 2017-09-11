<?php
namespace Fortifi\Sdk\OAuth;

use League\OAuth2\Client\Grant\AbstractGrant;

class ServiceAccountGrant extends AbstractGrant
{
  protected $_apiKey;
  protected $_apiUser;

  protected function getName()
  {
    return 'service_account';
  }

  protected function getRequiredRequestParameters()
  {
    return ['api_user', 'api_key'];
  }

  public function __construct($user, $key)
  {
    $this->_apiUser = $user;
    $this->_apiKey = $key;
  }

  public function prepareRequestParameters(array $defaults, array $options)
  {
    $options['api_user'] = $this->_apiUser;
    $options['api_key'] = $this->_apiKey;

    return parent::prepareRequestParameters($defaults, $options);
  }

  public function handleResponse($response = [])
  {
    return new FortifiAccessToken($response);
  }
}
