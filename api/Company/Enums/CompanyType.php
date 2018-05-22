<?php
namespace Fortifi\FortifiApi\Company\Enums;

use Fortifi\FortifiApi\Foundation\Enums\AbstractFortifiBitwiseEnum;

class CompanyType extends AbstractFortifiBitwiseEnum
{
  const BRAND = 1; //Standard Company
  const WHITELABEL = 2; //Company run by an affiliate

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::BRAND:
        return 'Brand';
      case self::WHITELABEL:
        return 'Whitelabel';
    }
    return $value;
  }

}
