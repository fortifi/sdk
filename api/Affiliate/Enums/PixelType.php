<?php
namespace Fortifi\FortifiApi\Affiliate\Enums;

use Fortifi\FortifiApi\Foundation\Enums\AbstractFortifiEnum;

final class PixelType extends AbstractFortifiEnum
{
  const IFRAME = 'iframe';
  const IMAGE = 'img';
  const JS = 'js';
  const CURL = 'curl';
  const HTML = 'html';

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::IFRAME:
        return 'Inline Frame';
      case self::IMAGE:
        return 'Image';
      case self::JS:
        return 'Javascript';
      case self::CURL:
        return 'Curl';
      case self::HTML:
        return 'HTML';
      default:
        return $value;
    }
  }
}
