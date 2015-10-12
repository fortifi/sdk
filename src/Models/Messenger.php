<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Messenger\Endpoints\MessengerDeliveryEndpoint;
use Fortifi\FortifiApi\Messenger\Enums\MessengerAction;
use Fortifi\FortifiApi\Messenger\Payloads\Actions\MessengerActionPayload;

class Messenger extends FortifiModel
{
  public function unsubscribe($deliveryFid)
  {
    /**
     * @return bool
     */
    $payload = new MessengerActionPayload();
    $payload->deliveryFid = $deliveryFid;
    $payload->userAgent = $this->_fortifi->getUserAgent();
    $payload->language = $this->_fortifi->getUserLanguage();
    $payload->encoding = $this->_fortifi->getUserEncoding();
    $payload->clientIp = $this->_fortifi->getClientIp();
    $payload->action = MessengerAction::UNSUBSCRIBED;

    $endpoint = MessengerDeliveryEndpoint::bound($this->_getApi());
    return (bool)$endpoint->trigger($payload)->result;
  }
}
