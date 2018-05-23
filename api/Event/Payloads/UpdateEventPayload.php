<?php
namespace Fortifi\FortifiApi\Event\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class UpdateEventPayload extends FidPayload
{
  public $name;
  public $description;
  public $colour;
  public $icon;
}
