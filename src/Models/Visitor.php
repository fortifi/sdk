<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateActionEndpoint;
use Fortifi\FortifiApi\Affiliate\Enums\AffiliateBuiltInAction;
use Fortifi\FortifiApi\Affiliate\Enums\ReversalReason;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\PostActionPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\ReversalPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Action\PostActionResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelsResponse;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Helpers\Affiliate\AffiliatePixelModel;
use Packaged\Helpers\ValueAs;

class Visitor extends FortifiModel
{
  protected $_visitorId;
  protected $_alias;
  protected $_pixels;

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
   * @param string $campaignHash
   * @param string $sid1
   * @param string $sid2
   * @param string $sid3
   *
   * @return PostActionResponse
   */
  public function triggerAction(
    $companyFid, $actionKey, $transactionId, $transactionValue = 0,
    array $data = null, $couponCode = null, $returnPixels = true,
    $userReference = null,
    $campaignHash = null, $sid1 = null, $sid2 = null, $sid3 = null
  )
  {
    $endpoint = AffiliateActionEndpoint::bound($this->_getApi());
    $payload = new PostActionPayload();
    $payload->userAgent = $this->_fortifi->getUserAgent();
    $payload->language = $this->_fortifi->getUserLanguage();
    $payload->clientIp = $this->_fortifi->getClientIp();
    $payload->encoding = $this->_fortifi->getUserEncoding();
    $payload->companyFid = $companyFid;
    $payload->actionKey = $actionKey;
    $payload->transactionId = $transactionId;
    $payload->transactionValue = $transactionValue;
    $payload->coupon = $couponCode;
    $payload->data = $data;
    $payload->returnPixels = $returnPixels;
    $payload->visitorId = $this->_visitorId;
    $payload->userReference = ValueAs::nonempty($userReference, $this->_alias);
    $payload->campaignHash = $campaignHash;
    $payload->sid1 = $sid1;
    $payload->sid2 = $sid2;
    $payload->sid3 = $sid3;

    $req = $endpoint->post($payload);
    $result = $this->_processRequest($req);

    if($returnPixels)
    {
      /**
       * @var $result PostActionResponse
       */
      $this->_pixels = $result->pixels;
    }

    return $result;
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
    $payload->encoding = $this->_fortifi->getUserEncoding();
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
   * Retrieve queued pixels (you must call clearPixels to remove the pixels)
   *
   * @return PixelsResponse
   */
  public function getPixels()
  {
    if(!$this->_pixels && !empty($this->_visitorId))
    {
      $endpoint = new AffiliatePixelModel($this->_getApi());
      $this->_pixels = $endpoint->getPending($this->_visitorId);
    }
    return $this->_pixels;
  }

  /**
   * Clear pixels already processed
   *
   * @return $this
   */
  public function clearPixels()
  {
    $this->_pixels = null;
    return $this;
  }
}
