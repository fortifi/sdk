<?php
namespace Fortifi\FortifiApi\Event\Payloads;

use Packaged\Api\Abstracts\AbstractApiPayload;

class UpdateEventPropertyPayload extends AbstractApiPayload
{
  public $eventFid;
  public $property;
  public $displayName;
  public $type;
  public $description;
  public $defaultValue;
}
