<?php
namespace Fortifi\FortifiApi\Affiliate\Payloads\Pixels;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class UpdatePixelPayload extends FidPayload
{
  public $displayName;
  public $pixelType;
  public $url;
  public $content;
}
