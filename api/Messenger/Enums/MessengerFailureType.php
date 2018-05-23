<?php
namespace Fortifi\FortifiApi\Messenger\Enums;

use Fortifi\FortifiApi\Foundation\Enums\AbstractFortifiEnum;

class MessengerFailureType extends AbstractFortifiEnum
{
  const HARD = 'hard';
  const SOFT = 'soft';

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::HARD:
        return 'Unrecoverable Failure';
      case self::SOFT:
        return 'Recoverable Failure';
      default:
        return $value;
    }
  }
}
