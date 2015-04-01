<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateActionEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\PostActionPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Action\PostActionResponse;

class Visitor extends FortifiModel
{
  protected $_visitorId;
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
   * @param $alias
   */
  public function alias($alias)
  {
  }

  /**
   * Trigger a visitor action
   *
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
    $actionKey, $transactionId, $transactionValue = 0, array $data = null,
    $couponCode = null, $returnPixels = true, $userReference = null
  )
  {
    $endpoint = AffiliateActionEndpoint::bound($this->_getApi());
    $payload = new PostActionPayload();
    $payload->actionKey = $actionKey;
    $payload->transactionId = $transactionId;
    $payload->transactionValue = $transactionValue;
    $payload->coupon = $couponCode;
    $payload->data = $data;
    $payload->returnPixels = $returnPixels;
    $payload->visitorId = $this->_visitorId;
    $payload->userReference = $userReference;

    $req = $endpoint->post($payload);
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
