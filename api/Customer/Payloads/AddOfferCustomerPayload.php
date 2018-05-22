<?php
namespace Fortifi\FortifiApi\Customer\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class AddOfferCustomerPayload extends FidPayload
{
  public $displayName;
  public $offerFid;
}
