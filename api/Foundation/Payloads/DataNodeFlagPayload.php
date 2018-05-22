<?php
namespace Fortifi\FortifiApi\Foundation\Payloads;

class DataNodeFlagPayload extends FidPayload
{
  public $flag;
  /**
   * @bool
   */
  public $value;

  public static function create($fid, $value = true)
  {
    $payload = parent::create($fid);
    /**
     * @var $payload static
     */
    $payload->value = $value;
    return $payload;
  }
}
