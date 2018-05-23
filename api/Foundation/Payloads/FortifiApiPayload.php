<?php
namespace Fortifi\FortifiApi\Foundation\Payloads;

use Packaged\Api\Abstracts\AbstractApiPayload;

abstract class FortifiApiPayload extends AbstractApiPayload
{
  public $fortifiPayloadVersion;
}
