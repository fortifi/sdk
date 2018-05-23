<?php
namespace Fortifi\FortifiApi\Customer\Responses;

use Fortifi\FortifiApi\Company\Responses\CompanyResponse;
use Fortifi\FortifiApi\Contact\Responses\PhoneResponse;
use Fortifi\FortifiApi\Employee\Responses\EmployeeResponse;
use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class CustomerResponse extends DataNodeResponse
{
  public $companyFid; //Unique with external reference
  /**
   * @var CompanyResponse
   */
  public $company;
  public $externalReference; //Unique Index with company fid

  /**
   * @var EmployeeResponse
   */
  public $accountManager;
  public $accountManagerFid;
  public $userFid;

  public $email = '';
  public $emailFid = '';
  public $phoneFid = '';

  /**
   * @var PhoneResponse
   */
  public $phone;
  public $firstName = '';
  public $lastName = '';

  //Affiliate Info
  public $affiliateFid = '';
  public $foundationFid = '';
  public $affiliateType = '';
  public $campaignFid = '';
  public $sid1 = '';
  public $sid2 = '';
  public $sid3 = '';

  //Enums
  public $lifecycleStage = '';
  public $accountType = '';
  public $accountStatus = '';
  public $subscriptionType = '';

  public $currency = '';
  public $currencySymbol = '';
  public $language = 'en';

  //Location
  public $continent = '';
  public $country = '';
  public $county = '';
  public $city = '';
  public $postal = '';
  public $timezone = '';

  //Numeric
  public $productsPurchased = 0; //Total number of products purchased

  //Numeric Currency
  public $totalPaid = 0.0; //Total revenue paid
  public $totalRefunded = 0.0; //Total revenue refunded
  public $totalSubscriptionPaid = 0.0; //Total revenue from subscriptions
  public $totalOneTimePaid = 0.0; //Total revenue from one time payments

  //Dates
  public $paidUntil = 0; //Expiry date of longest servicee
  public $subscriptionPaidUntil = 0; //Expiry date of longest subscription
  public $firstSubscribed = 0; //Date first became a paid subscription
  public $expiryDate = 0; //Expiry date for the customer
  public $firstPurchased = 0; //Date the customer first made a purchase

  public $trialStartDate = 0;
  public $trialEndDate = 0;

  public $contactSinceDate = 0;
  public $accountOpenDate = 0;
  public $accountReOpenDate = 0;
  public $accountCloseDate = 0;

  //Flags
  /**
   * @var bool
   */
  public $qualified = false;
  /**
   * @var bool
   */
  public $renewing = false;
  /**
   * @var bool
   */
  public $loyal = false;
  /**
   * @var bool
   */
  public $vip = false;
  /**
   * @var bool
   */
  public $fraud = false;
  /**
   * @var bool
   */
  public $chargeback = false;
  /**
   * @var bool
   */
  public $discount = false;
  /**
   * @var bool
   */
  public $impulse = false;
  /**
   * @var bool
   */
  public $refunded = false;
  /**
   * @var bool
   */
  public $hasSubscribed = false;
  /**
   * @var bool
   */
  public $isSubscribed = false;
  /**
   * @var bool
   */
  public $hasPurchased = false;
  /**
   * @var bool
   */
  public $isTestAccount = false;

  public function hydrate($data)
  {
    parent::hydrate($data);
    if(!empty($this->phone))
    {
      $this->phone = PhoneResponse::make($this->phone);
    }
  }
}
