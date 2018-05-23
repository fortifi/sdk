<?php
namespace Fortifi\FortifiApi\Foundation\Payloads;

use Packaged\Api\Abstracts\AbstractApiPayload;

class FiltersPayload extends AbstractApiPayload
{
  public $filters;

  public static function create(array $filters)
  {
    $payload = new static;
    $payload->filters = $filters;
    return $payload;
  }
}
