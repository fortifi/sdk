<?php
namespace Fortifi\FortifiApi\Affiliate\Payloads\Action;

class PostActionPayload extends BaseActionPayload
{
  public $actionKey; //Key for the action to trigger e.g. sale
  public $transactionId; //Reference for the event, e.g. order id
  public $transactionValue; //Transaction value, also used for revshare payout
  public $coupon; //Coupon used, if available
  /**
   * @bool
   */
  public $returnPixels = true; //Request pixels for response
  public $companyFid;
  /**
   * @nullable
   */
  public $timestamp; //time the action was processed, null for now.

  public $campaignHash;
  public $sid1;
  public $sid2;
  public $sid3;

  public $productCode;
  public $productTerm;
  public $paymentMethod;
  public $username;
}
