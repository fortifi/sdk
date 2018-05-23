<?php
namespace Fortifi\FortifiApi\Customer\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class CustomerAddressPayload extends FidPayload
{
  public $addressFid;

  public $displayName;
  public $description;
  public $address1;
  public $address2;
  public $address3;
  public $town;
  public $county;
  public $country;
  public $postalCode;
  public $setAsDefault = false;
}
