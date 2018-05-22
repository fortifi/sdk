<?php
namespace Fortifi\FortifiApi\Customer\Payloads;

use Packaged\Api\Abstracts\AbstractApiPayload;

class CreateCustomerPayload extends AbstractApiPayload
{
  /**
   * @optional
   * @length 32 64
   */
  public $companyFid;
  /**
   * @optional
   * @length 1 150
   */
  public $externalReference;
  /**
   * @optional
   * @length 1 150
   */
  public $accountManagerFid;
  /**
   * @email
   */
  public $email;
  /**
   * @optional
   * @length 1 120
   */
  public $firstName;
  /**
   * @optional
   * @length 1 120
   */
  public $lastName;

  /**
   * @optional
   * @nullable
   */
  public $timezone;

  public $language;

  public $accountType;
  public $accountStatus;
  public $subscriptionType;

  public $phoneNumber;
  public $userIp;

  public $currency;

  /**
   * Specify a creation time in seconds
   */
  public $createdTime;
  public $visitorId;

  /**
   * Set to true to prevent sending 'on-event' messenger messages
   */
  public $isImport = false;
}
