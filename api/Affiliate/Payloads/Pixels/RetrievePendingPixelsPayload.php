<?php
namespace Fortifi\FortifiApi\Affiliate\Payloads\Pixels;

use Packaged\Api\Abstracts\AbstractApiPayload;

class RetrievePendingPixelsPayload extends AbstractApiPayload
{
  /**
   * @length 1 64
   */
  public $visitorId;
}
