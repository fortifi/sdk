<?php
namespace Fortifi\Sdk\Models\DataNode;

use Fortifi\FortifiApi\DataNode\Payloads\DataNodeChangePayload;
use Fortifi\FortifiApi\DataNode\Responses\DataNodeChangeResponse;
use Fortifi\FortifiApi\DataNode\Responses\DataNodeChangesResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\DataNode\Endpoints\DataNodeChangesEndpoint;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class HistoryModel extends FortifiApiModel
{
  /**
   * @param string $fid
   *
   * @return DataNodeChangesResponse
   */
  public function all($fid)
  {
    $payload      = new FidPayload();
    $payload->fid = $fid;

    $ep = DataNodeChangesEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $objectFid
   * @param string $microtime
   *
   * @return DataNodeChangeResponse
   */
  public function retrieve($objectFid, $microtime)
  {
    $payload = new DataNodeChangePayload();
    $payload->objectFid = $objectFid;
    $payload->microtime = $microtime;

    $ep = DataNodeChangesEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }
}
