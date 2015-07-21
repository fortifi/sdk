<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Customer\Endpoints\CustomerEndpoint;
use Fortifi\FortifiApi\Customer\Payloads\CustomerEmailPayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerPhonePayload;

abstract class AbstractCustomer extends FortifiModel
{
  protected $_customerFid;
  protected $_externalReference;

  /**
   * Set
   *
   * @param mixed $externalReference
   *
   * @return $this
   */
  public function setExternalReference($externalReference)
  {
    $this->_externalReference = $externalReference;
    return $this;
  }

  public function addPhoneNumber($phoneNumber, $asDefault = false)
  {
    $payload = new CustomerPhonePayload();
    $payload->fid = $this->_customerFid;
    $payload->phone = $phoneNumber;
    $payload->setAsDefault = $asDefault;
    $ep = $this->_getEndpoint();
    $this->_processRequest($ep->addPhone($payload));
    return;
  }

  public function addEmailAddress($emailAddress, $asDefault = false)
  {
    $payload = new CustomerEmailPayload();
    $payload->fid = $this->_customerFid;
    $payload->email = $emailAddress;
    $payload->setAsDefault = $asDefault;
    $ep = $this->_getEndpoint();
    return $this->_processRequest($ep->addEmail($payload));
  }

  /**
   * @return CustomerEndpoint
   */
  protected function _getEndpoint()
  {
    return CustomerEndpoint::bound($this->_getApi());
  }
}
