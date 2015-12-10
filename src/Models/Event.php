<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Event\Endpoints\EventsEndpoint;
use Fortifi\FortifiApi\Event\Payloads\TriggerEventPayload;
use Fortifi\FortifiApi\Foundation\Fids\FidHelper;

class Event extends FortifiModel
{
  public function trigger(
    $dataNodeFid, $eventAlias, array $data = [], $triggerMessenger = true
  )
  {
    if(!FidHelper::isFid($dataNodeFid))
    {
      throw new \RuntimeException(
        "$dataNodeFid is not a valid FID"
      );
    }

    $payload = new TriggerEventPayload();
    $payload->fid = $dataNodeFid;
    $payload->alias = $eventAlias;
    $payload->properties = $data;
    $payload->triggerMessenger = $triggerMessenger;

    $endpoint = EventsEndpoint::bound($this->_getApi());
    return $this->_processRequest($endpoint->triggerEvent($payload));
  }
}
