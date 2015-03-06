<?php
namespace Fortifi\Sdk\Models\Auth;

use Fortifi\FortifiApi\Auth\Endpoints\UserEndpoint;
use Fortifi\FortifiApi\Auth\Payloads\SetPasswordPayload;
use Fortifi\FortifiApi\Auth\Responses\AuthUsernameResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class UserModel extends FortifiApiModel
{
  /**
   * @param $fid
   * @param $password
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setPassword($fid, $password)
  {
    $payload = new SetPasswordPayload();
    $payload->fid = $fid;
    $payload->password = $password;

    $ep = UserEndpoint::bound($this->getApi());
    return $ep->setPassword($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AuthUsernameResponse
   */
  public function getUserName($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = UserEndpoint::bound($this->getApi());
    return $ep->getUsername($payload)->get();
  }
}
