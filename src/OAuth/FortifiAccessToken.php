<?php
namespace Fortifi\Sdk\OAuth;

use League\OAuth2\Client\Token\AccessToken;

class FortifiAccessToken extends AccessToken
{
  protected $_secret;

  /**
   * Sets the token, expiry, etc values.
   *
   * @param  array $options token options
   */
  public function __construct(array $options = null)
  {
    if(isset($options['uid']) && !isset($options['resource_owner_id']))
    {
      $options['resource_owner_id'] = $options['uid'];
    }
    parent::__construct($options);

    if(isset($options['session_secret']))
    {
      $this->_secret = $options['session_secret'];
    }
  }

  public function getSessionSecret()
  {
    return $this->_secret;
  }
}
