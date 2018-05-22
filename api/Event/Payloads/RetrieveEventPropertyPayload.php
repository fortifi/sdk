<?php
namespace Fortifi\FortifiApi\Event\Payloads;

use Packaged\Api\Abstracts\AbstractApiPayload;

class RetrieveEventPropertyPayload extends AbstractApiPayload
{
  public $eventFid;
  public $property;
}
