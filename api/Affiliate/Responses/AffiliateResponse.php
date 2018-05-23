<?php
namespace Fortifi\FortifiApi\Affiliate\Responses;

use Fortifi\FortifiApi\Affiliate\Responses\Foundation\AffiliateFoundationResponse;
use Fortifi\FortifiApi\Auth\Responses\AuthUserResponse;
use Fortifi\FortifiApi\Contact\Responses\EmailResponse;
use Fortifi\FortifiApi\Contact\Responses\PhoneResponse;
use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class AffiliateResponse extends DataNodeResponse
{
  public $userFid;
  public $type; //Network|PPC|Affiliate
  public $displayName;
  public $name;
  public $companyName;
  public $phoneFid;
  public $emailFid;
  public $website;
  public $acceptedTerms;
  public $suspended;
  public $accountManagerFid;
  public $foundationFid;
  public $companyFid;
  public $approved;

  /**
   * @var AffiliateFoundationResponse
   */
  public $foundation;

  public $isDisabled;

  /**
   * @var AuthUserResponse
   */
  public $user;
  /**
   * @var EmailResponse
   */
  public $emailData;
  public $email;
  /**
   * @var PhoneResponse
   */
  public $phone;

  public $payoutType;

  public function hydrate($data)
  {
    parent::hydrate($data);
    if(!empty($this->user))
    {
      $this->user = AuthUserResponse::make($this->user);
    }
    if(!empty($this->emailNode))
    {
      $this->emailData = EmailResponse::make($this->emailData);
    }
    if(!empty($this->phone))
    {
      $this->phone = PhoneResponse::make($this->phone);
    }
  }
}
