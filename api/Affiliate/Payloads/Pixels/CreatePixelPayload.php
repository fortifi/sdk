<?php
namespace Fortifi\FortifiApi\Affiliate\Payloads\Pixels;

use Packaged\Api\Abstracts\AbstractApiPayload;

class CreatePixelPayload extends AbstractApiPayload
{
  public $affiliateFid;
  public $campaignFid;
  public $sid1;
  public $sid2;
  public $sid3;
  public $action;
  public $country;
  public $platform;
  public $displayName;
  public $pixelType;
  public $url;
  public $content;
  public $active;
}
