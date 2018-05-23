<?php
namespace Fortifi\FortifiApi\Affiliate\Responses\Pixels;

use Fortifi\FortifiApi\Affiliate\Responses\AffiliateResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Campaign\AffiliateCampaignResponse;
use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class PixelPolicyResponse extends DataNodeResponse
{
  public $affiliateFid;

  /**
   * @var AffiliateCampaignResponse
   */
  public $campaign;
  public $campaignFid;
  public $sid1;
  public $sid2;
  public $sid3;
  public $action;
  public $country;
  public $platform;
  public $pixelType;
  public $url;
  public $content;
  public $approved;
  public $approvedBy;
  public $approvedDate;
  public $active;

  /**
   * @var AffiliateResponse
   */
  public $affiliate;
}
