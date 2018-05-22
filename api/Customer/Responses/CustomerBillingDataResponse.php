<?php
namespace Fortifi\FortifiApi\Customer\Responses;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class CustomerBillingDataResponse extends FortifiApiResponse
{
  public $customerFid;
  public $billingType;
  public $taxNumber;
  public $companyNumber;
  public $knownIP;
}
