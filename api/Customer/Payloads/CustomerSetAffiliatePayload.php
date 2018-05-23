<?php
namespace Fortifi\FortifiApi\Customer\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class CustomerSetAffiliatePayload extends FidPayload
{
  public $affiliateFid;
  public $foundationFid;
  public $affiliateType;
  public $campaignFid;
  public $sid1;
  public $sid2;
  public $sid3;
}
