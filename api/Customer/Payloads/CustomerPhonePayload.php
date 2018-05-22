<?php
namespace Fortifi\FortifiApi\Customer\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class CustomerPhonePayload extends FidPayload
{
  public $phone;
  public $setAsDefault = false;
}
