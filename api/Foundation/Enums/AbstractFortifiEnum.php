<?php
namespace Fortifi\FortifiApi\Foundation\Enums;

use Packaged\Helpers\Strings;

abstract class AbstractFortifiEnum implements IFortifiEnum
{
  public static function getValues()
  {
    $oClass = new \ReflectionClass(get_called_class());
    return array_values($oClass->getConstants());
  }

  public static function getKeyedValues()
  {
    $return = [];
    foreach(static::getValues() as $value)
    {
      $return[$value] = static::getDisplayValue($value);
    }
    return $return;
  }

  public static function isValid($value)
  {
    return in_array($value, static::getValues(), false);
  }

  public static function isValidStrict($value)
  {
    return in_array($value, static::getValues(), true);
  }

  public static function getDisplayValue($value)
  {
    return Strings::titleize($value);
  }
}
