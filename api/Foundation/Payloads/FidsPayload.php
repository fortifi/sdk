<?php
namespace Fortifi\FortifiApi\Foundation\Payloads;

use Packaged\Api\Abstracts\AbstractApiPayload;

class FidsPayload extends AbstractApiPayload
{
  public $items = [];

  public static function create(array $fids)
  {
    $payload        = new static;
    $payload->items = $fids;
    return $payload;
  }

  public function addFid($fid)
  {
    $this->items   = (array)$this->items;
    $this->items[] = $fid;
  }
}
