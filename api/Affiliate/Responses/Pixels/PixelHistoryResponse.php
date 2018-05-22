<?php
namespace Fortifi\FortifiApi\Affiliate\Responses\Pixels;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class PixelHistoryResponse extends FortifiApiResponse
{
  public $pixelFid;
  /**
   * @var PixelPolicyResponse
   */
  public $pixel;
  public $eventTime;
  public $visitorId;
  public $eventId;
  public $event;
  public $triggered;
}
