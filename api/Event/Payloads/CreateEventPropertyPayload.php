<?php
namespace Fortifi\FortifiApi\Event\Payloads;

use Fortifi\FortifiApi\Event\Enums\EventPropertyType;
use Packaged\Api\Abstracts\AbstractApiPayload;

class CreateEventPropertyPayload extends AbstractApiPayload
{
  public $eventFid;
  public $property;
  public $displayName = '';
  public $type = EventPropertyType::STRING;
  public $description = '';
  public $defaultValue = '';
  public $defined = true;
}
