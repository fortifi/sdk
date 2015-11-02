<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Affiliate\Enums\AffiliateBuiltInAction;
use Fortifi\FortifiApi\Customer\Enums\CustomerAccountStatus;
use Fortifi\FortifiApi\Customer\Enums\CustomerAccountType;
use Fortifi\FortifiApi\Customer\Enums\CustomerSubscriptionType;
use Fortifi\FortifiApi\Customer\Payloads\CreateCustomerPayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerSetAffiliatePayload;
use Fortifi\FortifiApi\Customer\Responses\CustomerResponse;
use Fortifi\FortifiApi\Foundation\Enums\AdvancedFilterComparator;
use Fortifi\FortifiApi\Foundation\Exceptions\NotFoundException;
use Fortifi\FortifiApi\Foundation\Payloads\AdvancedFilterPayload;
use Fortifi\FortifiApi\Foundation\Payloads\DataNodePropertyPayload;
use Fortifi\FortifiApi\Foundation\Payloads\MarkDatePayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Packaged\Helpers\Arrays;
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
    $createCustomerPayload->userIp = $this->_fortifi->getClientIp();
    $createCustomerPayload->phoneNumber = $phoneNumber;
    $createCustomerPayload->visitorId = $this->getVisitorId();

    $customerEp = $this->_getEndpoint();
    $req = $customerEp->createCustomer($createCustomerPayload);
    $customer = $this->_processRequest($req);

    $this->_customerFid = $customer->fid;

    if($triggerLeadAction)
    {
      $trigger = $this->_fortifi->visitor($this->_visitorId)->triggerAction(
        $companyFid,
        AffiliateBuiltInAction::LEAD,
        $exRef,
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

    return $this;
  }

  /**
   * @param int|null $timestamp
   *
   * @return $this
   */
  public function markQualified($timestamp = null)
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot mark a customer as qualified before setting a customer fid"
      );
    }

    $ep = $this->_getEndpoint();
    $this->_processRequest(
      $ep->markQualified(
        MarkDatePayload::create($this->_customerFid, $timestamp)
      )
    );
    return $this;
  }

  /**
   * @param int|null $timestamp
   *
   * @return $this
   */
  public function markChargedback($timestamp = null)
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot mark a customer as chargedback before setting a customer fid"
      );
    }

    $ep = $this->_getEndpoint();
    $this->_processRequest(
      $ep->markChargeback(
        MarkDatePayload::create($this->_customerFid, $timestamp)
      )
    );
    return $this;
  }

  /**
   * @param int|null $timestamp
   *
   * @return $this
   */
  public function markFraud($timestamp = null)
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot mark a customer as fraud before setting a customer fid"
      );
    }

    $ep = $this->_getEndpoint();
    $this->_processRequest(
      $ep->markFraud(MarkDatePayload::create($this->_customerFid, $timestamp))
    );
    return $this;
  }

  /**
   * @param int|null $timestamp
   *
   * @return $this
   */
  public function markPurchased($timestamp = null)
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot mark a customer as purchased before setting a customer fid"
      );
    }

    $ep = $this->_getEndpoint();
    $this->_processRequest(
      $ep->markPurchased(
        MarkDatePayload::create($this->_customerFid, $timestamp)
      )
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

  public function setAccountStatus($status = CustomerAccountStatus::ACTIVE)
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot set a customers account status before setting a customer fid"
      );
    }

    $ep = $this->_getEndpoint();
    $this->_processRequest(
      $ep->setAccountStatus(
        DataNodePropertyPayload::create($this->_customerFid, $status)
      )
    );
    return $this;
  }

  public function setCurrency($currency = 'USD')
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot set a customers currency before setting a customer fid"
      );
    }

    if(strlen($currency) != 3)
    {
      throw new \RuntimeException(
        "You must specify the currency in ISO 4217 format"
      );
    }

    $ep = $this->_getEndpoint();
    $this->_processRequest(
      $ep->setCurrency(
        DataNodePropertyPayload::create($this->_customerFid, $currency)
      )
    );
    return $this;
  }

  /**
   * @param $reference
   *
   * @return CustomerResponse
   * @throws NotFoundException
   */
  public function retrieveCustomerByExternalReference($reference)
  {
    $ep = $this->_getEndpoint();
    $payload = new PaginatedDataNodePayload();
    $payload->filter = [
      AdvancedFilterPayload::create(
        'externalReference',
        AdvancedFilterComparator::EQUAL,
        $reference
      )
    ];
    $customers = $this->_processRequest($ep->all($payload));
    if(count($customers->items) >= 1)
    {
      return Arrays::first($customers->items);
    }
    else
    {
      throw new NotFoundException(
        "No customer could be located with the reference $reference"
      );
    }
  }
}
