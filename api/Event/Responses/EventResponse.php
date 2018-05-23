<?php
namespace Fortifi\FortifiApi\Event\Responses;

use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class EventResponse extends DataNodeResponse
{
  public $alias;
  public $icon;
  public $colour;
  public $type;
  public $isBuiltIn = false;
}
