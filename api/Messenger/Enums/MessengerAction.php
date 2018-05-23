<?php
namespace Fortifi\FortifiApi\Messenger\Enums;

use Fortifi\FortifiApi\Foundation\Enums\AbstractFortifiEnum;

class MessengerAction extends AbstractFortifiEnum
{
  const ANALYSED = 'analysed';
  const RETRIEVED = 'retrieved';
  const FILTERED = 'filtered';
  const COMPILED = 'compiled';

  const QUEUED = 'queued';
  const SENT = 'sent';
  const FAILED = 'failed';
  const OPENED = 'opened';
  const CLICKED = 'clicked';
  const BOUNCED = 'bounced';
  const COMPLAINED = 'complained';
  const SUBSCRIBED = 'subscribed';
  const UNSUBSCRIBED = 'unsubscribed';
  const CONVERTED = 'converted';

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::ANALYSED:
        return 'Analysed';
      case self::RETRIEVED:
        return 'Retrieved';
      case self::FILTERED:
        return 'Filtered';
      case self::COMPILED:
        return 'Compiled';
      case self::QUEUED:
        return 'Queued';
      case self::SENT:
        return 'Sent';
      case self::FAILED:
        return 'Failed';
      case self::OPENED:
        return 'Opened';
      case self::CLICKED:
        return 'Clicked';
      case self::BOUNCED:
        return 'Bounced';
      case self::COMPLAINED:
        return 'Complaints';
      case self::SUBSCRIBED:
        return 'Subscribed';
      case self::UNSUBSCRIBED:
        return 'Unsubscribed';
      case self::CONVERTED:
        return 'Converted';
      default:
        return $value;
    }
  }
}
