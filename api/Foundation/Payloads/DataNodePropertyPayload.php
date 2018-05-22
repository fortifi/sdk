<?php
namespace Fortifi\FortifiApi\Foundation\Payloads;

class DataNodePropertyPayload extends FidPayload
{
  public $value;

  public static function create($fid, $value = null)
  {
    $payload = parent::create($fid);
    /**
     * @var $payload static
     */
    $payload->value = $value;
    return $payload;
  }
}
