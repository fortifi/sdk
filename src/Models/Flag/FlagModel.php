<?php
namespace Fortifi\Sdk\Models\Flag;

use Fortifi\FortifiApi\Flag\Endpoints\FlagEndpoint;
use Fortifi\FortifiApi\Flag\Payloads\CreateFlagPayload;
use Fortifi\FortifiApi\Flag\Payloads\ListFlagsPayload;
use Fortifi\FortifiApi\Flag\Responses\FlagsResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class FlagModel extends FortifiApiModel
{
  /**
   * @param $userFid
   *
   * @return FlagsResponse
   */
  public function all($userFid)
  {
    $payload = new ListFlagsPayload();
    $payload->userFid = $userFid;

    $ep = FlagEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param $userFid
   * @param $objectFid
   * @param $colour
   * @param $notes
   *
   * @return BoolResponse
   */
  public function create($userFid, $objectFid, $colour = null, $notes = null)
  {
    $payload = new CreateFlagPayload();
    $payload->userFid = $userFid;
    $payload->objectFid = $objectFid;
    $payload->colour = $colour;
    $payload->notes = $notes;

    $ep = FlagEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param $fid
   *
   * @return BoolResponse
   */
  public function delete($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = FlagEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }
}
