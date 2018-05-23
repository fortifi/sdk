<?php
namespace Fortifi\FortifiApi\Messenger\Payloads\Actions;

use Fortifi\FortifiApi\Traffic\Enums\PlatformType;
use Packaged\Api\Abstracts\AbstractApiPayload;

class MessengerActionPayload extends AbstractApiPayload
{
  public $timestamp;
  public $deliveryFid;
  public $action;
  public $userAgent; //HTTP_USER_AGENT
  public $language; //HTTP_ACCEPT_LANGUAGE
  public $encoding; //HTTP_ACCEPT_ENCODING
  public $clientIp; //REMOTE_ADDR

  public $os = '';
  public $osVersion = '';
  public $osBlended = '';
  public $platform = PlatformType::OTHER;
  public $device = '';
  public $client = '';
  public $clientVersion = '';
  public $clientBlended = '';
  public $referrer = '';

  public $companyFid;
  public $visitorId;

  public $triggerFid = ''; //e.g. Order FID
  public $amount = 0;//e.g. Sale Amount
  public $sourceType = '';
}
