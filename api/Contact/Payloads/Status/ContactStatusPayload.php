<?php
namespace Fortifi\FortifiApi\Contact\Payloads\Status;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class ContactStatusPayload extends FidPayload
{
  public $emailAddress;
  public $phoneNumber;
  public $companyFid;
  public $groupFid;
}
