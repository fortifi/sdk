<?php
namespace Fortifi\FortifiApi\Event\Endpoints;

use Fortifi\FortifiApi\Event\Payloads\CreateEventPayload;
use Fortifi\FortifiApi\Event\Payloads\CreateEventPropertyPayload;
use Fortifi\FortifiApi\Event\Payloads\DefineEventPropertyPayload;
use Fortifi\FortifiApi\Event\Payloads\RetrieveEventPropertyPayload;
use Fortifi\FortifiApi\Event\Payloads\TriggerEventPayload;
use Fortifi\FortifiApi\Event\Payloads\UpdateEventPayload;
use Fortifi\FortifiApi\Event\Payloads\UpdateEventPropertyPayload;
use Fortifi\FortifiApi\Event\Responses\EventDataNodeEventsResponse;
use Fortifi\FortifiApi\Event\Responses\EventPropertiesResponse;
use Fortifi\FortifiApi\Event\Responses\EventPropertyResponse;
use Fortifi\FortifiApi\Event\Responses\EventResponse;
use Fortifi\FortifiApi\Event\Responses\EventsResponse;
use Fortifi\FortifiApi\Foundation\Endpoints\AbstractFortifiEndpoint;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class EventsEndpoint extends AbstractFortifiEndpoint
{
  protected $_path = '/event/';

  /**
   * @param PaginatedDataNodePayload $payload
   *
   * @return FortifiApiRequestInterface|EventsResponse
   */
  public function all(PaginatedDataNodePayload $payload)
  {
    return self::_createRequest($payload, 'list');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|EventResponse
   */
  public function retrieve(FidPayload $payload)
  {
    return self::_createRequest($payload, 'retrieve');
  }

  /**
   * @param CreateEventPayload $payload
   *
   * @return FortifiApiRequestInterface|DataNodeResponse
   */
  public function create(CreateEventPayload $payload)
  {
    return self::_createRequest($payload, 'create');
  }

  /**
   * @param UpdateEventPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update(UpdateEventPayload $payload)
  {
    return self::_createRequest($payload, 'update');
  }

  /**
   * @param RetrieveEventPropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|EventPropertyResponse
   */
  public function retrieveProperty(RetrieveEventPropertyPayload $payload)
  {
    return self::_createRequest($payload, 'properties/retrieve');
  }

  /**
   * @param CreateEventPropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function createProperty(CreateEventPropertyPayload $payload)
  {
    return self::_createRequest($payload, 'properties/create');
  }

  /**
   * @param DefineEventPropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function defineProperty(DefineEventPropertyPayload $payload)
  {
    return self::_createRequest($payload, 'properties/define');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|EventPropertiesResponse
   */
  public function listEventProperties(FidPayload $payload)
  {
    return self::_createRequest($payload, 'properties/list');
  }

  /**
   * @param UpdateEventPropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function updateEventProperty(UpdateEventPropertyPayload $payload)
  {
    return self::_createRequest($payload, 'properties/update');
  }

  /**
   * @param TriggerEventPayload $payload
   *
   * @return FortifiApiRequestInterface|null
   */
  public function triggerEvent(TriggerEventPayload $payload)
  {
    return self::_createRequest($payload, 'trigger');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|EventDataNodeEventsResponse
   */
  public function datanodeEvents(FidPayload $payload)
  {
    return self::_createRequest($payload, 'datanode/events');
  }
}
