<?php
namespace Fortifi\FortifiApi\Edge\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FilteredPaginatedPayload;

class EdgePayload extends FilteredPaginatedPayload
{
  public $fid;
  public $loadRefs = false;

  public static function create($fid, $loadRefs = false)
  {
    $payload = new static;
    $payload->fid = $fid;
    $payload->loadRefs = $loadRefs;
    return $payload;
  }
}
