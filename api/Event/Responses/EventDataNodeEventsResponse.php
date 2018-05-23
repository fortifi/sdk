<?php
namespace Fortifi\FortifiApi\Event\Responses;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class EventDataNodeEventsResponse extends FortifiApiResponse
{
  /**
   * @var EventDataNodeEventResponse[]
   */
  public $events = [];

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'events',
      '\Fortifi\FortifiApi\Event\Responses\EventDataNodeEventResponse'
    );
  }
}

