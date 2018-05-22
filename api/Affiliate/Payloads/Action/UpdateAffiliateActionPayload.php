<?php
namespace Fortifi\FortifiApi\Affiliate\Payloads\Action;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class UpdateAffiliateActionPayload extends FidPayload
{
  public $displayName;
  public $description;
  public $approvalType;
  public $approvalDays;
  public $maxCommission;
  public $url;
  public $redirectCode;
  public $lookupUrl;
}
