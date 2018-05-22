<?php
namespace Fortifi\FortifiApi\Foundation\Enums;

use Packaged\Helpers\Arrays;

abstract class AbstractFortifiBitwiseEnum extends AbstractFortifiEnum
{
  public static function getBWDisplayValue($value)
  {
    $bits = [];
    for($i = 1; $i <= $value; $i = $i * 2)
    {
      if($i & $value)
      {
        $bits[] = static::getDisplayValue($i);
      }
    }

    return Arrays::toList($bits);
  }

  public static function isValid($value)
  {
    $total = 0;
    foreach(static::getValues() as $val)
    {
      $total = $total | $val;
    }
    return ($total & $value) === $value;
  }
}
