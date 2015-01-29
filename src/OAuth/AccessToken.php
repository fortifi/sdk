<?php
namespace Fortifi\Sdk\OAuth;

class AccessToken extends \League\OAuth2\Client\Token\AccessToken
{
  protected $_secret;

  /**
   * Sets the token, expiry, etc values.
   *
   * @param  array $options token options
   */
  public function __construct(array $options = null)
  {
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
