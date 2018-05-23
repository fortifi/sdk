<?php
namespace Fortifi\FortifiApi\Property\Payloads\Definitions;

use Packaged\Api\Abstracts\AbstractApiPayload;

class CreatePropertyDefinitionPayload extends AbstractApiPayload
{
  public $fidType;
  public $fidSubType;
  public $baseFid;

  public $key;

  public $displayName;
  public $description;
  public $groupFid;
  public $type;
  public $values;
}
