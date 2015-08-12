<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Affiliate\Enums\AffiliateBuiltInAction;
use Fortifi\FortifiApi\Affiliate\Enums\ReversalReason;
use Fortifi\FortifiApi\Customer\Enums\CustomerAccountStatus;
use Fortifi\FortifiApi\Customer\Enums\CustomerAccountType;
use Fortifi\FortifiApi\Customer\Enums\CustomerSubscriptionType;
use Fortifi\FortifiApi\Customer\Payloads\CreateCustomerPayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerSetAffiliatePayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerSetLocationPayload;
use Fortifi\FortifiApi\Foundation\Payloads\DataNodePropertyPayload;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Packaged\Helpers\ValueAs;

class Customer extends AbstractCustomer
{
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
   * Retrieve the current defined customer Fid
   *
   * @return string|null
   */
  public function getCustomerFid()
  {
    return $this->_customerFid;
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
   * Retrieve the current visitor ID
   *
   * @return string
   */
  public function getVisitorId()
  {
    return $this->_visitorId;
  }

  /**
   * Create a new customer (and trigger a lead)
   *
   * @param string $companyFid
   * @param string $email
   * @param string $firstName
   * @param string $lastName
   * @param string $phoneNumber
   * @param string $reference                   Your internal ID for this
   *                                            customer (e.g. user id)
   * @param string $accountType
   * @param string $accountStatus
   * @param string $subscriptionType
   * @param bool   $triggerLeadAction
   * @param int    $createdTime
   *
   * @return $this
   */
  public function create(
    $companyFid, $email, $firstName, $lastName = null, $phoneNumber = null,
    $reference = null, $accountType = CustomerAccountType::RESIDENTIAL,
    $accountStatus = CustomerAccountStatus::ACTIVE,
    $subscriptionType = CustomerSubscriptionType::FREE,
    $triggerLeadAction = false, $createdTime = null
  )
  {
    $exRef = ValueAs::nonempty($reference, $this->_externalReference);

    $createCustomerPayload = new CreateCustomerPayload();
    $createCustomerPayload->externalReference = $exRef;
    $createCustomerPayload->companyFid = $companyFid;
    $createCustomerPayload->email = $email;
    $createCustomerPayload->firstName = $firstName;
    $createCustomerPayload->lastName = $lastName;
    $createCustomerPayload->accountType = $accountType;
    $createCustomerPayload->accountStatus = $accountStatus;
    $createCustomerPayload->subscriptionType = $subscriptionType;
    $createCustomerPayload->createdTime = $createdTime;

    $customerEp = $this->_getEndpoint();
    $req = $customerEp->createCustomer($createCustomerPayload);
    $customer = $this->_processRequest($req);

    $this->_customerFid = $customer->fid;

    if(!empty($phoneNumber))
    {
      try
      {
        $this->addPhoneNumber($phoneNumber, true);
      }
      catch(\Exception $e)
      {
      }
    }

    if($triggerLeadAction)
    {
      $trigger = $this->_fortifi->visitor($this->_visitorId)->triggerAction(
        $companyFid,
        AffiliateBuiltInAction::LEAD,
        $reference,
        0,
        [
          'customerFid'        => $this->_customerFid,
          'email'              => $email,
          'first_name'         => $firstName,
          'last_name'          => $lastName,
          'phone_number'       => $phoneNumber,
          'external_reference' => $exRef,
          'accountType'        => $accountType,
          'accountStatus'      => $accountStatus,
          'subscriptionType'   => $subscriptionType,
        ]
      );

      if(!empty($trigger->visitorId))
      {
        $this->setVisitorId($trigger->visitorId);
      }

      $affPayload = new CustomerSetAffiliatePayload();
      $affPayload->affiliateFid = $trigger->affiliate;
      $affPayload->fid = $this->_customerFid;
      $affPayload->sid1 = $trigger->sid1;
      $affPayload->sid2 = $trigger->sid2;
      $affPayload->sid3 = $trigger->sid3;
      try
      {
        $this->_processRequest(
          $this->_getEndpoint()->setAffiliate($affPayload)
        );
      }
      catch(\Exception $e)
      {
      }
    }

    try
    {
      $locationPayload = new CustomerSetLocationPayload();
      $locationPayload->fid = $this->_customerFid;
      $locationPayload->userIp = $this->_fortifi->getClientIp();
      $this->_processRequest(
        $this->_getEndpoint()->setLocation($locationPayload)
      );
    }
    catch(\Exception $e)
    {
    }

    return $this;
  }

  public function markQualified()
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot mark a customer as qualified before setting a customer fid"
      );
    }

    $ep = $this->_getEndpoint();
    $this->_processRequest(
      $ep->markQualified(FidPayload::create($this->_customerFid))
    );
    return $this;
  }

  public function markPurchased()
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot mark a customer as purchased before setting a customer fid"
      );
    }

    $ep = $this->_getEndpoint();
    $this->_processRequest(
      $ep->markPurchased(FidPayload::create($this->_customerFid))
    );
    return $this;
  }

  public function setLoyal($bool = true)
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot set a customers loyalty before setting a customer fid"
      );
    }

    $ep = $this->_getEndpoint();
    $this->_processRequest(
      $ep->setLoyal(DataNodePropertyPayload::create($this->_customerFid, $bool))
    );
    return $this;
  }

  public function setVIP($bool = true)
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot set a customers VIP status before setting a customer fid"
      );
    }

    $ep = $this->_getEndpoint();
    $this->_processRequest(
      $ep->setVip(DataNodePropertyPayload::create($this->_customerFid, $bool))
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
   *
   * @return $this
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
    return $this;
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
