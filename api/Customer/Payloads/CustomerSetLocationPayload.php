<?php
namespace Fortifi\FortifiApi\Customer\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class CustomerSetLocationPayload extends FidPayload
{
  public $continent;
  public $country;
  public $county;
  public $city;
  public $postal;
  public $timezone;
  public $userIp;
}
