<?php
namespace Fortifi\FortifiApi\Affiliate\Enums;

use Fortifi\FortifiApi\Foundation\Enums\AbstractFortifiEnum;

final class ReversalReason extends AbstractFortifiEnum
{
  const CHARGEBACK = 'chargeback';
  const CANCEL = 'cancel';
  const FRAUD = 'fraud';

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::CHARGEBACK:
        return 'Chargeback';
      case self::CANCEL:
        return 'Cancellation';
      case self::FRAUD:
        return 'Fraud';
      default:
        return $value;
    }
  }
}
