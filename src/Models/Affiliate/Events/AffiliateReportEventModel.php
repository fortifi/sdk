<?php
namespace Fortifi\Sdk\Models\Affiliate\Events;

use Fortifi\FortifiApi\Affiliate\Endpoints\Events\AffiliateReportEventEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Events\Report\AffiliateReportEventPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Events\Report\AffiliateReportEventsResponse;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\FidResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateReportEventModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return AffiliateReportEventsResponse|FortifiApiRequestInterface
   */
  public function all($limit = 10, $page = 1, $sortField = null,
    $sortDirection = null, $showDeleted = false, $filter = null
  )
  {
    $payload                = new PaginatedDataNodePayload();
    $payload->limit         = $limit;
    $payload->page          = $page;
    $payload->sortField     = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted   = $showDeleted;
    $payload->filter        = $filter;

    $ep = AffiliateReportEventEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $year
   * @param string $month
   * @param string $day
   * @param string $hour
   * @param string $minute
   * @param string $companyFid
   * @param string $affiliateFid
   * @param string $campaignHash
   * @param string $sid1
   * @param string $sid2
   * @param string $sid3
   * @param string $visitorFid
   * @param string $eventFid
   * @param string $action
   * @param string $affiliateRole
   * @param string $marketingType
   * @param string $marketingId
   * @param string $country
   * @param string $language
   * @param string $os
   * @param string $platform
   * @param string $device
   * @param string $client
   * @param string $ip
   * @param string $referrer
   * @param string $transactionId
   * @param string $transactionValue
   * @param string $commission
   * @param string $tqs
   *
   * @return FortifiApiRequestInterface|FidResponse
   */
  public function create($year, $month, $day, $hour, $minute, 
    $companyFid, $affiliateFid, $campaignHash, $sid1, $sid2, 
    $sid3, $visitorFid, $eventFid, $action, $affiliateRole,
    $marketingType, $marketingId, $country, $language, $os, 
    $platform, $device, $client, $ip, $referrer, 
    $transactionId, $transactionValue, $commission, $tqs
  )
  {
    $payload = new AffiliateReportEventPayload();

    $payload->year              = $year;
    $payload->month             = $month;
    $payload->day               = $day;
    $payload->hour              = $hour;
    $payload->minute            = $minute;
    
    $payload->companyFid        = $companyFid;
    $payload->affiliateFid      = $affiliateFid;
    $payload->campaignHash      = $campaignHash;
    $payload->sid1              = $sid1;
    $payload->sid2              = $sid2;
    $payload->sid3              = $sid3;
    
    $payload->visitorFid        = $visitorFid;
    $payload->eventFid          = $eventFid;
    $payload->action            = $action;
    $payload->affiliateRole     = $affiliateRole;
    
    $payload->marketingType     = $marketingType;
    $payload->marketingId       = $marketingId;
    
    $payload->country           = $country;
    $payload->language          = $language;
    $payload->os                = $os;
    $payload->platform          = $platform;
    $payload->device            = $device;
    $payload->client            = $client;
    $payload->ip                = $ip;
    $payload->referrer          = $referrer;
    
    $payload->transactionId     = $transactionId;
    $payload->transactionValue  = $transactionValue;
    $payload->commission        = $commission;
    $payload->tqs               = $tqs;

    $ep = AffiliateReportEventEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }
}
