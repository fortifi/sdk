<?php
namespace Fortifi\FortifiApi\Affiliate\Payloads\Action;

class ReversalPayload extends BaseActionPayload
{
  public $reason; //ReversalReason enum
  public $reversalId; //Your reference for this event
  public $reversalAmount; //Amount of revenue reversed (e.g. refunds)

  public $sourceActionKey = 'sale';//Reversal of X action type e.g. sale
  public $sourceTransactionId; //Your reference for the original action, e.g order ID

  public $eventId; //Event ID if known

  /**
   * @nullable
   */
  public $timestamp; //time the action was processed, null for now.
}
