<?php
namespace Fortifi\FortifiApi\Property\Payloads\Definitions;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class UpdatePropertyDefinitionPayload extends FidPayload
{
  public $displayName;
  public $description;
  public $groupFid;
  public $values;
}
