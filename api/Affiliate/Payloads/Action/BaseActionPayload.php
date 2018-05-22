<?php
namespace Fortifi\FortifiApi\Affiliate\Payloads\Action;

use Packaged\Api\Abstracts\AbstractApiPayload;

abstract class BaseActionPayload extends AbstractApiPayload
{
  public $visitorId; //Known visitor ID
  public $userReference; //Allocate reference to visitor id
  public $data; // Random misc data
  public $userAgent; //HTTP_USER_AGENT
  public $language; //HTTP_ACCEPT_LANGUAGE
  public $encoding; //HTTP_ACCEPT_ENCODING
  public $clientIp; //REMOTE_ADDR
}
