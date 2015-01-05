<?php
namespace Fortifi\Sdk\Models\AuthLogs;

use Fortifi\FortifiApi\Auth\Endpoints\AuthEndpoint;
use Fortifi\FortifiApi\Auth\Payloads\LoginLogPayload;
use Fortifi\FortifiApi\Auth\Responses\LoginLogResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AuthLogModel extends FortifiApiModel
{
  /**
   * @param string $fid
   * @param bool   $success
   *
   * @return LoginLogResponse
   */
  public function retrieve($fid, $success)
  {
    $payload             = new LoginLogPayload();
    $payload->fid        = $fid;
    $payload->successful = $success;

    $ep = AuthEndpoint::bound($this->getApi());
    return $ep->loginLog($payload)->get();
  }
}
