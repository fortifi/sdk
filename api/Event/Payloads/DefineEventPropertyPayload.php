<?php
namespace Fortifi\FortifiApi\Event\Payloads;

use Packaged\Api\Abstracts\AbstractApiPayload;

class DefineEventPropertyPayload extends AbstractApiPayload
{
  public $eventFid;
  public $property;
}
