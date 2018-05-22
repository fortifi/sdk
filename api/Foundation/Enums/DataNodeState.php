<?php
namespace Fortifi\FortifiApi\Foundation\Enums;

class DataNodeState extends AbstractFortifiEnum
{
  const ACTIVE = 0; //Data is all good
  const ARCHIVED = 1; //Data is archived
  const PENDING = 2; //Data in a changing state
  const CORRUPT = 3; //Data is known to be corrupt

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::ACTIVE:
        return 'Active';
      case self::ARCHIVED:
        return 'Archived';
      case self::PENDING:
        return 'Pending';
      case self::CORRUPT:
        return 'Corrupt';
      default:
        return $value;
    }
  }
}
