<?php
namespace Fortifi\FortifiApi\Property\Payloads\Groups;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class UpdatePropertyGroupPayload extends FidPayload
{
  public $displayName;
  public $description;
}
