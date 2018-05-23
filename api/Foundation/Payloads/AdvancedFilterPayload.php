<?php

namespace Fortifi\FortifiApi\Foundation\Payloads;

use Fortifi\FortifiApi\Foundation\Enums\AdvancedFilterComparator;
use Packaged\Api\Abstracts\AbstractApiPayload;
use Packaged\Helpers\Arrays;
use Packaged\Helpers\Strings;
use Packaged\Helpers\ValueAs;

class AdvancedFilterPayload extends AbstractApiPayload
{
  public $key;
  /**
   * @var AdvancedFilterComparator
   */
  public $comparator;
  public $value;

  public static function create($key, $comparator, $value)
  {
    $payload = new static();
    $payload->key = $key;
    $payload->comparator = $comparator;
    $payload->value = $value;
    return $payload;
  }

  public function checkValue($value)
  {
    switch($this->comparator)
    {
      case AdvancedFilterComparator::EQUAL;
        $return = $value == $this->value;
        break;
      case AdvancedFilterComparator::NOT_EQUAL;
        $return = $value != $this->value;
        break;
      case AdvancedFilterComparator::EQUAL_INSENSITIVE;
        $return = strcasecmp($value, $this->value) === 0;
        break;
      case AdvancedFilterComparator::NOT_EQUAL_INSENSITIVE;
        $return = strcasecmp($value, $this->value) !== 0;
        break;
      case AdvancedFilterComparator::GREATER_THAN;
        $return = $value > $this->value;
        break;
      case AdvancedFilterComparator::GREATER_THAN_EQUAL;
        $return = $value >= $this->value;
        break;
      case AdvancedFilterComparator::LESS_THAN;
        $return = $value < $this->value;
        break;
      case AdvancedFilterComparator::LESS_THAN_EQUAL;
        $return = $value <= $this->value;
        break;
      case AdvancedFilterComparator::BETWEEN;
        list($min, $max) = explode(',', $this->value);
        $return = $value >= $min && $value <= $max;
        break;
      case AdvancedFilterComparator::NOT_BETWEEN;
        list($min, $max) = explode(',', $this->value);
        $return = !($value >= $min && $value <= $max);
        break;
      case AdvancedFilterComparator::IN;
        $return = Arrays::contains(ValueAs::arr($this->value), $value);
        break;
      case AdvancedFilterComparator::NOT_IN;
        $return = !Arrays::contains(ValueAs::arr($this->value), $value);
        break;
      case AdvancedFilterComparator::LIKE:
        $return = !!preg_match($this->_getLikeRegex($this->value), $value);
        break;
      case AdvancedFilterComparator::NOT_LIKE:
        $return = !preg_match($this->_getLikeRegex($this->value), $value);
        break;
      case AdvancedFilterComparator::STARTS_WITH:
        $return = Strings::startsWith($value, $this->value);
        break;
      case AdvancedFilterComparator::NOT_STARTS_WITH:
        $return = !Strings::startsWith($value, $this->value);
        break;
      case AdvancedFilterComparator::ENDS_WITH:
        $return = Strings::endsWith($value, $this->value);
        break;
      case AdvancedFilterComparator::NOT_ENDS_WITH:
        $return = !Strings::endsWith($value, $this->value);
        break;
      default:
        throw new \RuntimeException(
          "Comparator " . AdvancedFilterComparator::getDisplayValue(
            $this->comparator
          ) . ' is not currently supported with checkValue'
        );
    }

    return $return;
  }

  private function _getLikeRegex($string)
  {
    $regex = preg_quote($string, '/');
    $regex = preg_replace('/(?<!\\\\)%/', '.*?', $regex);
    $regex = str_replace('\\\\%', '\\%', $regex);
    return '/^' . $regex . '$/';
  }

  public function isValid()
  {
    return !empty($this->key) && !empty($this->comparator);
  }

  /**
   * @param string $useName  Use this as the key
   * @param string $useValue Use this as the value
   *
   * @return string
   */
  public function getReadableValue($useName = null, $useValue = null)
  {
    $useName = $useName ?: ucwords(Strings::humanize($this->key));
    $useValue = $useValue ?: $this->value;
    if(is_array($useValue))
    {
      $useValue = implode(', ', ValueAs::arr($useValue));
    }

    $nonIsComparators = [
      AdvancedFilterComparator::STARTS_WITH,
      AdvancedFilterComparator::NOT_STARTS_WITH,
      AdvancedFilterComparator::ENDS_WITH,
      AdvancedFilterComparator::NOT_ENDS_WITH,
    ];

    if(!in_array($this->comparator, $nonIsComparators))
    {
      $useName .= ' is';
    }

    if(in_array(
      $this->comparator,
      [AdvancedFilterComparator::BETWEEN, AdvancedFilterComparator::NOT_BETWEEN]
    ))
    {
      list($min, $max) = explode(',', $useValue);
      return $useName . ' between ' . trim($min) . ' and ' . trim($max);
    }

    if(is_bool($useValue))
    {
      return $useName . ' ' . ($useValue ? 'true' : 'false');
    }

    return $useName . ' '
      . AdvancedFilterComparator::getDisplayValue($this->comparator) . ' '
      . $useValue;
  }
}
