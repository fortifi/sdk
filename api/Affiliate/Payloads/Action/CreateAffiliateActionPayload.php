<?php
namespace Fortifi\FortifiApi\Affiliate\Payloads\Action;

use Packaged\Api\Abstracts\AbstractApiPayload;

class CreateAffiliateActionPayload extends AbstractApiPayload
{
  public $companyFid;
  public $key;
  public $displayName;
  public $description;
  public $type;
  public $approvalType;
  public $approvalDays;
  public $maxCommission;
  public $url;
  public $redirectCode;
  public $lookupUrl;
}
