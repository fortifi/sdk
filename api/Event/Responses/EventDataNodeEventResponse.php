<?php
namespace Fortifi\FortifiApi\Event\Responses;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class EventDataNodeEventResponse extends FortifiApiResponse
{
  public $eventFid;
  /**
   * @var EventResponse
   */
  public $event;
  public $microtime;
  public $dataNodeFid;
  public $properties;
}
