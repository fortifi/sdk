<?php
namespace Fortifi\FortifiApi\Foundation\Payloads;

use Fortifi\FortifiApi\Foundation\Fids\FidHelper;
use Packaged\Api\Abstracts\AbstractApiPayload;

class FidPayload extends AbstractApiPayload
{
  public $fid;

  /**
   * @param string $fid
   *
   * @return static
   */
  public static function create($fid)
  {
    if(!(is_numeric($fid) || FidHelper::isFid($fid)))
    {
      throw new \InvalidArgumentException('Not a valid Fid or ID');
    }
    $payload = new static;
    $payload->fid = $fid;
    return $payload;
  }
}
