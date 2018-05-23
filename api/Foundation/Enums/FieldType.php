<?php
namespace Fortifi\FortifiApi\Foundation\Enums;

class FieldType extends AbstractFortifiEnum
{
  const TEXT = 'text';
  const TEXT_AREA = 'textarea';
  const OPTION = 'option';
  const BOOL = 'bool';
  const MULTIPLE_CHOICE = 'm.choice';

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::TEXT:
        return 'Text';
      case self::TEXT_AREA:
        return 'Text Area';
      case self::OPTION:
        return 'Option';
      case self::BOOL:
        return 'Boolean';
      case self::MULTIPLE_CHOICE:
        return 'Multiple Choice';
      default:
        return $value;
    }
  }
}
