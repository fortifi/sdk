<?php
namespace Fortifi\Sdk\Models\Affiliate\Events;

use Fortifi\FortifiApi\Affiliate\Endpoints\Events\AffiliateVisitorEventEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Events\Visitor\AffiliateVisitorEventPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Events\Visitor\AffiliateVisitorEventsResponse;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\FidResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateVisitorEventModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return AffiliateVisitorEventsResponse|FortifiApiRequestInterface
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

    $ep = AffiliateVisitorEventEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $visitorFid
   * @param string $eventFid
   * @param string $actionFid
   * @param string $actionKey
   * @param string $ip
   * @param string $knownIp
   * @param string $deviceFid
   * @param string $knownDevice
   * @param string $referralUrl
   * @param string $knownReferral
   * @param string $affiliateFid
   * @param string $campaignHash
   * @param string $sid1
   * @param string $sid2
   * @param string $sid3
   * @param string $tqs
   * @param string $approved
   * @param string $transactionId
   * @param string $transactionAmount
   * @param string $commissionPolicyFid
   * @param string $tqpPolicyFid
   * @param string $autoTqpPolicyFid
   * @param string $fraudPolicyFid
   *
   * @return FortifiApiRequestInterface|FidResponse
   */
  public function create($visitorFid, $eventFid, $actionFid, $actionKey,
    $ip, $knownIp, $deviceFid, $knownDevice, $referralUrl, $knownReferral,
    $affiliateFid, $campaignHash, $sid1, $sid2, $sid3, $tqs, $approved,
    $transactionId, $transactionAmount, $commissionPolicyFid, $tqpPolicyFid,
    $autoTqpPolicyFid, $fraudPolicyFid
  )
  {
    $payload = new AffiliateVisitorEventPayload();

    $payload->visitorFid = $visitorFid;
    $payload->eventFid = $eventFid;

    $payload->actionFid = $actionFid;
    $payload->actionKey = $actionKey;

    $payload->ip = $ip;
    $payload->knownIp = $knownIp;
    $payload->deviceFid = $deviceFid;
    $payload->knownDevice = $knownDevice;
    $payload->referralUrl = $referralUrl;
    $payload->knownReferral = $knownReferral;

    $payload->affiliateFid = $affiliateFid;
    $payload->campaignHash = $campaignHash;
    $payload->sid1 = $sid1;
    $payload->sid2 = $sid2;
    $payload->sid3 = $sid3;

    $payload->tqs = $tqs;
    $payload->approved = $approved;

    $payload->transactionId = $transactionId;
    $payload->transactionAmount = $transactionAmount;

    $payload->commissionPolicyFid = $commissionPolicyFid;
    $payload->tqpPolicyFid = $tqpPolicyFid;
    $payload->autoTqpPolicyFid = $autoTqpPolicyFid;
    $payload->fraudPolicyFid = $fraudPolicyFid;

    $ep = AffiliateVisitorEventEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }
}
