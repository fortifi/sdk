<?php
namespace Fortifi\FortifiApi\Traffic\Responses;

use Fortifi\FortifiApi\Affiliate\Responses\AffiliateResponse;
use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class VisitorResponse extends FortifiApiResponse
{
  public $id;

  public $firstSeen;
  public $lastSeen;

  //Most Recent Values
  public $currentDeviceFid;
  public $currentReferrerUrl;
  public $currentAffiliateFid;
  public $currentCampaignHash;
  public $currentSid1;
  public $currentSid2;
  public $currentSid3;
  public $currentIp;

  //Locked In Values
  public $lockedDeviceFid;
  public $lockedReferrerUrl;
  public $lockedAffiliateFid;
  public $lockedCampaignHash;
  public $lockedSid1;
  public $lockedSid2;
  public $lockedSid3;

  /**
   * @var AffiliateResponse
   */
  public $currentAffiliate;

  /**
   * @var AffiliateResponse
   */
  public $lockedAffiliate;
}
