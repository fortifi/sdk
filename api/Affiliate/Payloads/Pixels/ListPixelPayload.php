<?php
namespace Fortifi\FortifiApi\Affiliate\Payloads\Pixels;

use Packaged\Api\Abstracts\AbstractApiPayload;

class ListPixelPayload extends AbstractApiPayload
{
  public $affiliateFid;
  public $showPending;
}
