<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Customer\Endpoints\CustomerEndpoint;
use Fortifi\FortifiApi\Customer\Payloads\CustomerEmailPayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerPhonePayload;
use Fortifi\FortifiApi\Property\Endpoints\PropertyEndpoint;
use Fortifi\FortifiApi\Property\Payloads\SetPropertyValuePayload;
use Packaged\Helpers\ValueAs;

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
    return $this;
  }

  public function addEmailAddress($emailAddress, $asDefault = false)
  {
    $payload = new CustomerEmailPayload();
    $payload->fid = $this->_customerFid;
    $payload->email = $emailAddress;
    $payload->setAsDefault = $asDefault;
    $ep = $this->_getEndpoint();
    $this->_processRequest($ep->addEmail($payload));
    return $this;
  }

  /**
   * @return CustomerEndpoint
   */
  protected function _getEndpoint()
  {
    return CustomerEndpoint::bound($this->_getApi());
  }

  /**
   * @return PropertyEndpoint
   */
  protected function _getPropertyEndpoint()
  {
    return PropertyEndpoint::bound($this->_getApi());
  }

  public function setFlag($name, $value = true)
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot set a flag before setting a customer fid"
      );
    }

    $payload = new SetPropertyValuePayload();
    $payload->fid = $this->_customerFid;
    $payload->property = $name;
    $payload->value = ValueAs::bool($value);
    $this->_processRequest($this->_getPropertyEndpoint()->setFlag($payload));

    return $this;
  }

  public function setValue($name, $value)
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot set a value before setting a customer fid"
      );
    }

    $payload = new SetPropertyValuePayload();
    $payload->fid = $this->_customerFid;
    $payload->property = $name;
    $payload->value = ValueAs::string($value);
    $this->_processRequest($this->_getPropertyEndpoint()->setValue($payload));

    return $this;
  }

  public function incrementCounter($name, $value = 1)
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot increment a counter  before setting a customer fid"
      );
    }

    $payload = new SetPropertyValuePayload();
    $payload->fid = $this->_customerFid;
    $payload->property = $name;
    $payload->value = ValueAs::int($value, 1);
    $this->_processRequest(
      $this->_getPropertyEndpoint()->incrementCounter($payload)
    );

    return $this;
  }

  public function decrementCounter($name, $value = 1)
  {
    if(empty($this->_customerFid))
    {
      throw new \RuntimeException(
        "You cannot decrement a counter before setting a customer fid"
      );
    }

    $payload = new SetPropertyValuePayload();
    $payload->fid = $this->_customerFid;
    $payload->property = $name;
    $payload->value = ValueAs::int($value, 1);
    $this->_processRequest(
      $this->_getPropertyEndpoint()->decrementCounter($payload)
    );

    return $this;
  }
}
