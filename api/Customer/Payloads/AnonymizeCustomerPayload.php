<?php
namespace Fortifi\FortifiApi\Customer\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class AnonymizeCustomerPayload extends FidPayload
{
  public $customer = false;
  public $tickets = false;
  public $chats = false;
  public $orders = false;
  public $emails = false;
  public $phones = false;
}
