<?php
namespace Fortifi\FortifiApi\Event\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class TriggerEventPayload extends FidPayload
{
  public $alias; //Event Alias
  public $microtime;
  public $properties = [];
  public $triggerMessenger = false;
}
