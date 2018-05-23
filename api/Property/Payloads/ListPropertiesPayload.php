<?php
namespace Fortifi\FortifiApi\Property\Payloads;

use Packaged\Api\Abstracts\AbstractApiPayload;

class ListPropertiesPayload extends AbstractApiPayload
{
  public $fidType;
  public $fidSubType;
  public $baseFid;
  public $groupFid;
}
