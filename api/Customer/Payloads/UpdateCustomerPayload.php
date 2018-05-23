<?php
namespace Fortifi\FortifiApi\Customer\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class UpdateCustomerPayload extends FidPayload
{
  public $firstName;
  public $lastName;
}
