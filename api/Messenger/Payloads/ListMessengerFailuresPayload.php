<?php
namespace Fortifi\FortifiApi\Messenger\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Messenger\Enums\MessengerFailureType;

class ListMessengerFailuresPayload extends FidPayload
{
  public $type; // MessengerFailureType
  public $limit = 5;

  /**
   * @param string $fid
   * @param string $type
   *
   * @return static
   */
  public static function create($fid, $type = MessengerFailureType::HARD)
  {
    /** @var static $payload */
    $payload = parent::create($fid);
    $payload->type = $type;
    return $payload;
  }
}
