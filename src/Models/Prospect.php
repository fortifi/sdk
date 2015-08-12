<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Customer\Enums\CustomerAccountType;
use Fortifi\FortifiApi\Customer\Payloads\CreateCustomerPayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerSetLocationPayload;
use Packaged\Helpers\ValueAs;

class Prospect extends AbstractCustomer
{
  /**
   * @param $prospectFid
   *
   * @return $this
   */
  public function setProspectFid($prospectFid)
  {
    $this->_customerFid = $prospectFid;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getProspectFid()
  {
    return $this->_customerFid;
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
   *
   * @return $this
   */
  public function create(
    $companyFid, $email, $firstName, $lastName = null, $phoneNumber = null,
    $reference = null, $accountType = CustomerAccountType::RESIDENTIAL,
    $createdTime = null
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
}
