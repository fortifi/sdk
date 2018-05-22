<?php
namespace Fortifi\FortifiApi\Event\Enums;

use Fortifi\FortifiApi\Foundation\Enums\AbstractFortifiEnum;

final class EventPropertyType extends AbstractFortifiEnum
{
  const STRING = 's';
  const INTEGER = 'i';
  const DATE = 'd';
  const BOOL = 'b';
  const JSON = 'j';

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case static::STRING:
        return "String";
      case static::INTEGER:
        return "Integer";
      case static::DATE:
        return "Date";
      case static::BOOL:
        return "Boolean";
      case static::JSON:
        return "JSON";
    }
    return $value;
  }
}
