<?php
namespace Fortifi\FortifiApi\Affiliate\Responses\Campaign;

use Fortifi\FortifiApi\Company\Responses\CompanyResponse;
use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class AffiliateCampaignResponse extends DataNodeResponse
{
  public $hash;
  public $affiliateFid;
  public $companyFid;
  public $options;

  /**
   * @var CompanyResponse
   */
  public $company;
}
