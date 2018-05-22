<?php
namespace Fortifi\FortifiApi\Property\Payloads\Groups;

use Packaged\Api\Abstracts\AbstractApiPayload;

class CreatePropertyGroupPayload extends AbstractApiPayload
{
  public $fidType;
  public $fidSubType;
  public $baseFid;
  public $displayName;
  public $description;
}
