<?php
namespace Fortifi\FortifiApi\Property\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class SetPropertyValuePayload extends FidPayload
{
  public $property;
  public $value;
}
