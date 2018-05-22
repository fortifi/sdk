<?php
namespace Fortifi\FortifiApi\Messenger\Endpoints;

use Fortifi\FortifiApi\Foundation\Endpoints\AbstractFortifiEndpoint;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Messenger\Payloads\Actions\MessengerActionPayload;
use Fortifi\FortifiApi\Messenger\Payloads\ListMessengerFailuresPayload;
use Fortifi\FortifiApi\Messenger\Responses\Failures\MessengerFailuresResponse;

class MessengerDeliveryEndpoint extends AbstractFortifiEndpoint
{
  protected $_path = '/messenger/delivery/';

  /**
   * @param MessengerActionPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function trigger(MessengerActionPayload $payload)
  {
    return self::_createRequest($payload, 'trigger-action');
  }

  /**
   * @param ListMessengerFailuresPayload $payload
   *
   * @return FortifiApiRequestInterface|MessengerFailuresResponse
   */
  public function listFailures(ListMessengerFailuresPayload $payload)
  {
    return self::_createRequest($payload, 'list-failures');
  }

}
