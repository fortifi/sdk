<?php
namespace Fortifi\FortifiApi\Event\Payloads;

use Packaged\Api\Abstracts\AbstractApiPayload;

class CreateEventPayload extends AbstractApiPayload
{
  public $alias;
  public $name;
  public $description;
  public $colour;
  public $icon;
  public $type;
}
