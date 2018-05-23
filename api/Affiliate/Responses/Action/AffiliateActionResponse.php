<?php
namespace Fortifi\FortifiApi\Affiliate\Responses\Action;

use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class AffiliateActionResponse extends DataNodeResponse
{
  public $companyFid;
  public $key;
  public $type;
  public $approvalType;
  public $approvalDays;
  public $maxCommission;
  public $url;
  public $redirectCode;
  public $lookupUrl;
  public $isBuiltIn;
}
