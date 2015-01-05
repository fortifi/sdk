<?php
namespace Fortifi\FortifiCo\Applications\ActivityFeed\Models;

use Fortifi\FortifiApi\ActivityFeed\Endpoints\ActivityFeedEndpoint;
use Fortifi\FortifiApi\ActivityFeed\Payloads\ActivityFeedPayload;
use Fortifi\FortifiApi\ActivityFeed\Responses\ActivityFeedsResponse;
use Fortifi\FortifiApi\Company\Responses;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class ActivityFeedModel extends FortifiApiModel
{

  /**
   * @param int    $objectFid
   * @param int    $time
   * @param int    $limit
   * @param string $order
   *
   * @return ActivityFeedsResponse
   */
  public function retrieve($objectFid, $time, $limit = 10, $order = 'asc')
  {
    $payload = new ActivityFeedPayload();
    $payload->fid = $objectFid;
    $payload->startMicro = $time;
    $payload->limit = $limit;
    $payload->descending = $order;

    $ep = ActivityFeedEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }
}
