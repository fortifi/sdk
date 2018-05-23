<?php
namespace Fortifi\FortifiApi\Customer\Enums;

use Fortifi\FortifiApi\Foundation\Enums\AbstractFortifiEnum;

final class CustomerAccountStatus extends AbstractFortifiEnum
{
  const SETUP = 'setup';
  const ACTIVE = 'active';
  const SUSPENDED = 'suspended';
  const EXPIRED = 'expired';
  const CANCELLED = 'cancelled';

  public static function getDisplayValue($value)
  {
    return ucfirst($value);
  }
}
