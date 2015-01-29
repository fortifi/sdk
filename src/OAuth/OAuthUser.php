<?php
namespace Fortifi\Sdk\OAuth;

use Fortifi\FortifiApi\Auth\Responses\AuthUserDetailsResponse;
use League\OAuth2\Client\Entity\User;

class OAuthUser extends User
{
  protected $_authUserDetails;

  /**
   * @return AuthUserDetailsResponse
   */
  public function getAuthUserDetails()
  {
    return $this->_authUserDetails;
  }

  public function setAuthUserDetails(AuthUserDetailsResponse $details)
  {
    $this->_authUserDetails = $details;
    return $this;
  }
}
