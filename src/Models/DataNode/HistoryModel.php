<?php
namespace Fortifi\Sdk\Models\DataNode;

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
}
