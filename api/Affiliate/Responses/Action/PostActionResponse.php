<?php
namespace Fortifi\FortifiApi\Affiliate\Responses\Action;

use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelsResponse;
use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class PostActionResponse extends FortifiApiResponse
{
  public $visitorId;
  public $eventId;
  public $actionKey;
  public $sid1;
  public $sid2;
  public $sid3;
  public $affiliate;
  public $affiliateName;
  public $affiliateType;
  public $campaign;
  public $commission;

  /**
   * @var PixelsResponse
   */
  public $pixels;

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->pixels = PixelsResponse::make($this->pixels);
  }
}
