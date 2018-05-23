<?php
namespace Fortifi\FortifiApi\Foundation\Payloads;

use Packaged\Api\Abstracts\AbstractApiPayload;

class CreateDataNodePayload extends AbstractApiPayload
{
  public $displayName;
  public $description;
}
