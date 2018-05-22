<?php
namespace Fortifi\FortifiApi\Customer\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class CustomerEmailPayload extends FidPayload
{
  public $email;
  public $setAsDefault = false;
}
