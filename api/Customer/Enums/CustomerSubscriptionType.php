<?php
namespace Fortifi\FortifiApi\Customer\Enums;

use Fortifi\FortifiApi\Foundation\Enums\AbstractFortifiEnum;

final class CustomerSubscriptionType extends AbstractFortifiEnum
{
  const TRIAL = 'trial';
  const FREE = 'free';
  const PAID = 'paid';
  const NONE = 'none';

  public static function getDisplayValue($value)
  {
    return ucfirst($value);
  }
}
