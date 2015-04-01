<?php
namespace Fortifi\Sdk\Models;

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
   * @param string $email
   * @param string $firstName
   * @param string $lastName
   * @param string $phoneNumber
   * @param string $reference Your internal ID for this customer (e.g. user id)
   *
   * @return $this
   */
  public function create(
    $email, $firstName, $lastName = null, $phoneNumber = null, $reference = null
  )
  {
    return $this;
  }

  /**
   * Record a customer subscription purchase
   *
   * @param       $transactionId
   * @param int   $transactionValue
   * @param array $data
   */
  public function purchase(
    $transactionId, $transactionValue = 0, array $data = null
  )
  {
  }

  /**
   * Record a customer subscription renewal
   *
   * @param       $transactionId
   * @param int   $transactionValue
   * @param array $data
   */
  public function renewed(
    $transactionId, $transactionValue = 0, array $data = null
  )
  {
  }

  /**
   * Record a customer upsell puchase
   *
   * @param       $transactionId
   * @param int   $transactionValue
   * @param array $data
   */
  public function purchaseUpsell(
    $transactionId, $transactionValue = 0, array $data = null
  )
  {
  }

  /**
   * Mark a transaction as chargebacked
   *
   * @param       $transactionId
   * @param int   $chargebackAmount
   * @param array $data
   */
  public function chargeback(
    $transactionId, $chargebackAmount = 0, array $data = null
  )
  {
  }

  /**
   * Mark a transaction as cancelled
   *
   * @param       $transactionId
   * @param int   $transactionAmount
   * @param array $data
   */
  public function cancel(
    $transactionId, $transactionAmount = 0, array $data = null
  )
  {
  }

  /**
   * Mark a transaction as fraud
   *
   * @param       $transactionId
   * @param int   $transactionAmount
   * @param array $data
   */
  public function markAsFraud(
    $transactionId, $transactionAmount = 0, array $data = null
  )
  {
  }
}
