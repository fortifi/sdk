<?php
namespace Fortifi\Sdk\Models\DataNode;

use Fortifi\FortifiApi\DataNode\Endpoints\DataNodeEventsEndpoint;
use Fortifi\FortifiApi\DataNode\Payloads\DataNodeEventPayload;
use Fortifi\FortifiApi\DataNode\Responses\DataNodeEventsResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class EventsModel extends FortifiApiModel
{
  /**
   * @param string $fid
   *
   * @return DataNodeEventsResponse
   */
  public function retrieve($fid, $startMicro = null, $limit = null)
  {
    $payload = new DataNodeEventPayload();
    $payload->fid = $fid;
    $payload->startMicro = $startMicro;
    $payload->limit = $limit;

    $ep = DataNodeEventsEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }
}
