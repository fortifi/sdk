<?php
namespace Fortifi\FortifiApi\Foundation\Enums;

class AdvancedFilterComparator extends AbstractFortifiEnum
{
  const EQUAL = 'eq';
  const NOT_EQUAL = 'neq';
  const EQUAL_INSENSITIVE = 'eqi';
  const NOT_EQUAL_INSENSITIVE = 'neqi';
  const IN = 'in';
  const NOT_IN = 'nin';
  const GREATER_THAN = 'gt';
  const GREATER_THAN_EQUAL = 'gte';
  const LESS_THAN = 'lt';
  const LESS_THAN_EQUAL = 'lte';
  const BETWEEN = 'bet';
  const NOT_BETWEEN = 'nbet';
  const LIKE = 'like';
  const NOT_LIKE = 'nlike';
  const LIKE_IN = 'likein';
  const NOT_LIKE_IN = 'nlikein';
  const STARTS_WITH = 'starts';
  const NOT_STARTS_WITH = 'nstarts';
  const ENDS_WITH = 'ends';
  const NOT_ENDS_WITH = 'nends';
  const BEFORE = 'before';
  const AFTER = 'after';

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::EQUAL:
        return 'Equal To';
      case self::NOT_EQUAL:
        return 'Not Equal To';
      case self::EQUAL_INSENSITIVE:
        return 'Equal To (Case Insensivite)';
      case self::NOT_EQUAL_INSENSITIVE:
        return 'Not Equal To (Case Insensivite)';
      case self::IN:
        return 'One Of';
      case self::NOT_IN:
        return 'Not One Of';
      case self::GREATER_THAN:
        return 'Greater Than';
      case self::GREATER_THAN_EQUAL:
        return 'Greater Than or Equal To';
      case self::LESS_THAN:
        return 'Less Than';
      case self::LESS_THAN_EQUAL:
        return 'Less Than or Equal To';
      case self::BETWEEN:
        return 'Between';
      case self::NOT_BETWEEN:
        return 'Not Between';
      case self::LIKE:
        return 'Like';
      case self::NOT_LIKE:
        return 'Not Like';
      case self::LIKE_IN:
        return 'Like (One Of)';
      case self::NOT_LIKE_IN:
        return 'Not Like (One Of)';
      case self::STARTS_WITH:
        return 'Starts With';
      case self::NOT_STARTS_WITH:
        return 'Does not start with';
      case self::ENDS_WITH:
        return 'Ends With';
      case self::NOT_ENDS_WITH:
        return 'Does not ends with';
      case self::BEFORE:
        return 'Before';
      case self::AFTER:
        return 'After';
      default:
        return $value;
    }
  }
}
