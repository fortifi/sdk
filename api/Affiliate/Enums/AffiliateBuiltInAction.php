<?php
namespace Fortifi\FortifiApi\Affiliate\Enums;

use Fortifi\FortifiApi\Foundation\Enums\AbstractFortifiEnum;

class AffiliateBuiltInAction extends AbstractFortifiEnum
{
  const CLICK = 'click';
  const LEAD = 'lead';
  const ACQUISITION = 'acquisition';
  const UPSELL = 'upsell';
  const RENEWAL = 'renewal';
  const REVERSAL = 'reversal';

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::CLICK:
        return 'Click';
      case self::LEAD:
        return 'Lead';
      case self::ACQUISITION:
        return 'Acquisition';
      case self::UPSELL:
        return 'Upsell';
      case self::RENEWAL:
        return 'Renewal';
      case self::REVERSAL:
        return 'Reversal';
      default:
        return $value;
    }
  }
}
