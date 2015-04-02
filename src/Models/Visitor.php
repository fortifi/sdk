<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateActionEndpoint;
use Fortifi\FortifiApi\Affiliate\Enums\AffiliateBuiltInAction;
use Fortifi\FortifiApi\Affiliate\Enums\ReversalReason;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\PostActionPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\ReversalPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Action\PostActionResponse;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;

class Visitor extends FortifiModel
{
  protected $_visitorId;
  protected $_alias;
  protected $_pixels = [];

  /**
   * @param $visitorId
   *
   * @return $this
   */
  public function setVisitorId($visitorId)
  {
    $this->_visitorId = $visitorId;
    return $this;
  }

  /**
   * Create an alias for the current visitor
   *
   * Please be aware, when setting the same alias on multiple visitors, the most
   * recent visitor be used
   *
   * This will only be applied to the next trigger action call
   *
   * @param $alias
   *
   * @return Visitor
   */
  public function alias($alias)
  {
    $this->_alias = $alias;
    return $this;
  }

  /**
   * Trigger a visitor action
   *
   * @param        $companyFid
   * @param        $actionKey
   * @param        $transactionId
   * @param int    $transactionValue
   * @param array  $data
   * @param null   $couponCode
   * @param bool   $returnPixels
   * @param string $userReference
   *
   * @return PostActionResponse
   */
  public function triggerAction(
    $companyFid, $actionKey, $transactionId, $transactionValue = 0,
    array $data = null, $couponCode = null, $returnPixels = true,
    $userReference = null
  )
  {
    $endpoint = AffiliateActionEndpoint::bound($this->_getApi());
    $payload = new PostActionPayload();
    $payload->userAgent = $this->_fortifi->getUserAgent();
    $payload->language = $this->_fortifi->getUserLanguage();
    $payload->clientIp = $this->_fortifi->getClientIp();
    $payload->companyFid = $companyFid;
    $payload->actionKey = $actionKey;
    $payload->transactionId = $transactionId;
    $payload->transactionValue = $transactionValue;
    $payload->coupon = $couponCode;
    $payload->data = $data;
    $payload->returnPixels = $returnPixels;
    $payload->visitorId = $this->_visitorId;
    $payload->userReference = nonempty($userReference, $this->_alias);

    $req = $endpoint->post($payload);
    return $this->_processRequest($req);
  }

  /**
   * Reverse a previously triggered action
   *
   * @param        $transactionId
   * @param string $originalAction
   * @param string $reason
   * @param null   $reversalId
   * @param int    $reversalAmount
   * @param array  $data
   *
   * @return BoolResponse
   */
  public function reverseAction(
    $transactionId, $originalAction = AffiliateBuiltInAction::ACQUISITION,
    $reason = ReversalReason::CANCEL, $reversalId = null, $reversalAmount = 0,
    array $data = null
  )
  {
    $endpoint = AffiliateActionEndpoint::bound($this->_getApi());
    $payload = new ReversalPayload();
    $payload->userAgent = $this->_fortifi->getUserAgent();
    $payload->language = $this->_fortifi->getUserLanguage();
    $payload->clientIp = $this->_fortifi->getClientIp();
    $payload->reason = $reason;
    $payload->reversalAmount = $reversalAmount;
    $payload->reversalId = $reversalId;
    $payload->sourceActionKey = $originalAction;
    $payload->sourceTransactionId = $transactionId;
    $payload->data = $data;
    $payload->visitorId = $this->_visitorId;

    $req = $endpoint->reverse($payload);
    return $this->_processRequest($req);
  }

  /**
   * Retrieve queued pixels
   *
   * @param bool $loadFromApi set to false to only retrieve pixels from
   *                          triggerAction requests
   * @param bool $clear       Clear pixels from the queue on retrieval
   *
   * @return array
   */
  public function getPixels($loadFromApi = false, $clear = true)
  {
    if(!$loadFromApi)
    {
      $return = (array)$this->_pixels;
      if($clear)
      {
        $this->_pixels = [];
      }
      return $return;
    }
    return [];
  }
}
