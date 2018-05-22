<?php
namespace Fortifi\FortifiApi\Customer\Enums;

use Fortifi\FortifiApi\Foundation\Enums\AbstractFortifiEnum;

final class CustomerAccountType extends AbstractFortifiEnum
{
  const UNKNOWN = 'unknown';
  const RESIDENTIAL = 'residential';
  const BUSINESS = 'business';
  const ENTERPRISE = 'enterprise';
  const STUDENT = 'student';
  const CHARITY = 'charity';
  const GROUP = 'group';

  public static function getDisplayValue($value)
  {
    return ucfirst($value);
  }
}
