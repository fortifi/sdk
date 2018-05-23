<?php
namespace Fortifi\FortifiApi\Event\Responses;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class EventPropertyResponse extends FortifiApiResponse
{
  public $eventFid;
  public $property;
  public $displayName;
  public $type;
  public $description;
  public $defaultValue;
  public $defined;
}
