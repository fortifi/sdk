<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Affiliate\Enums\AffiliateBuiltInAction;
use Fortifi\FortifiApi\Affiliate\Enums\ReversalReason;

class Customer extends FortifiModel
{
  protected $_customerFid;
  protected $_visitorId;

  /**
   * @param $customerFid
   *
   * @return $this
   */
  public function setCustomerFid($customerFid)
  {
    $this->_customerFid = $customerFid;
    return $this;
  }

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
   * Create a new customer (and trigger a lead)
   *
   * @param string $companyFid
   * @param string $email
   * @param string $firstName
   * @param string $lastName
   * @param string $phoneNumber
   * @param string $reference Your internal ID for this customer (e.g. user id)
   *
   * @return $this
   */
  public function create(
    $companyFid, $email, $firstName, $lastName = null, $phoneNumber = null,
    $reference = null
  )
  {
    $this->_fortifi->visitor($this->_visitorId)->triggerAction(
      $companyFid,
      AffiliateBuiltInAction::LEAD,
      $reference,
      0,
      [
        'email'              => $email,
        'first_name'         => $firstName,
        'last_name'          => $lastName,
        'phone_number'       => $phoneNumber,
        'external_reference' => $reference,
      ]
    );
    return $this;
  }

  /**
   * Record a customer subscription purchase
   *
   * @param string $companyFid
   * @param        $transactionId
   * @param int    $transactionValue
   * @param array  $data
   *
   * @return $this
   */
  public function purchase(
    $companyFid, $transactionId, $transactionValue = 0, array $data = null
  )
  {
    $this->_fortifi->visitor($this->_visitorId)->triggerAction(
      $companyFid,
      AffiliateBuiltInAction::ACQUISITION,
      $transactionId,
      $transactionValue,
      $data
    );
    return $this;
  }

  /**
   * Record a customer subscription renewal
   *
   * @param string $companyFid
   * @param        $transactionId
   * @param int    $transactionValue
   * @param array  $data
   */
  public function renewed(
    $companyFid, $transactionId, $transactionValue = 0, array $data = null
  )
  {
    $this->_fortifi->visitor($this->_visitorId)->triggerAction(
      $companyFid,
      AffiliateBuiltInAction::RENEWAL,
      $transactionId,
      $transactionValue,
      $data
    );
  }

  /**
   * Record a customer upsell puchase
   *
   * @param string $companyFid
   * @param        $transactionId
   * @param int    $transactionValue
   * @param array  $data
   */
  public function purchaseUpsell(
    $companyFid, $transactionId, $transactionValue = 0, array $data = null
  )
  {
    $this->_fortifi->visitor($this->_visitorId)->triggerAction(
      $companyFid,
      AffiliateBuiltInAction::UPSELL,
      $transactionId,
      $transactionValue,
      $data
    );
  }

  /**
   * Mark a transaction as chargebacked
   *
   * @param       $transactionId
   * @param       $originalAction
   * @param       $chargebackId
   * @param int   $chargebackAmount
   * @param array $data
   */
  public function chargeback(
    $transactionId, $originalAction = AffiliateBuiltInAction::ACQUISITION,
    $chargebackId, $chargebackAmount = 0, array $data = null
  )
  {
    $this->_fortifi->visitor($this->_visitorId)->reverseAction(
      $transactionId,
      $originalAction,
      ReversalReason::CHARGEBACK,
      $chargebackId,
      $chargebackAmount,
      $data
    );
  }

  /**
   * Mark a transaction as cancelled
   *
   * @param       $transactionId
   * @param       $originalAction
   * @param       $cancelId
   * @param int   $cancelAmount
   * @param array $data
   */
  public function cancel(
    $transactionId, $originalAction = AffiliateBuiltInAction::ACQUISITION,
    $cancelId = null, $cancelAmount = 0, array $data = null
  )
  {
    $this->_fortifi->visitor($this->_visitorId)->reverseAction(
      $transactionId,
      $originalAction,
      ReversalReason::CANCEL,
      $cancelId,
      $cancelAmount,
      $data
    );
  }

  /**
   * Mark a transaction as fraud
   *
   * @param       $transactionId
   * @param       $originalAction
   * @param array $data
   */
  public function markAsFraud(
    $transactionId, $originalAction = AffiliateBuiltInAction::ACQUISITION,
    array $data = null
  )
  {
    $this->_fortifi->visitor($this->_visitorId)->reverseAction(
      $transactionId,
      $originalAction,
      ReversalReason::FRAUD,
      null,
      0,
      $data
    );
  }
}
