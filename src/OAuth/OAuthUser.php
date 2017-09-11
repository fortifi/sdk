<?php
namespace Fortifi\Sdk\OAuth;

use Fortifi\FortifiApi\Auth\Responses\AuthUserDetailsResponse;
use League\OAuth2\Client\Provider\GenericResourceOwner;

class OAuthUser extends GenericResourceOwner
{
  protected $_authUserDetails;

  public function getId()
  {
    if($this->_authUserDetails instanceof AuthUserDetailsResponse)
    {
      return $this->_authUserDetails->userFid ?: $this->resourceOwnerId;
    }
    return $this->resourceOwnerId;
  }

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
