<?php
namespace Fortifi\FortifiApi\Traffic\Enums;

use Fortifi\FortifiApi\Foundation\Enums\AbstractFortifiEnum;

final class PlatformType extends AbstractFortifiEnum
{
  const TABLET = 'tablet';
  const SMARTPHONE = 'smartphone';
  const DESKTOP = 'desktop';
  const CONSOLE = 'console';
  const TV = 'tv';
  const OTHER = 'other';
  const BOT = 'bot';

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::TABLET:
        return 'Tablet';
      case self::SMARTPHONE:
        return 'Smartphone';
      case self::DESKTOP:
        return 'Desktop';
      case self::CONSOLE:
        return 'Console';
      case self::TV:
        return 'Television';
      case self::OTHER:
        return 'Other';
      case self::BOT:
        return 'Bot';
      default:
        return $value;
    }
  }
}
