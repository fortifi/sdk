<?php
namespace Fortifi\FortifiApi\Foundation\Fids;

use Fortifi\FortifiApi\Foundation\Exceptions\InvalidFidException;

class FidHelper
{
  /**
   * @param string $fid
   *
   * @return string
   *
   * @throws InvalidFidException
   */
  public static function getType($fid)
  {
    $parts = explode(':', $fid);
    switch(count($parts))
    {
      case 5:
      case 4:
        return $parts[1];
      default:
        throw new InvalidFidException("Invalid FID Passed '$fid'", 500);
    }
  }

  /**
   * @param string $fid
   *
   * @return string
   *
   * @throws InvalidFidException
   */
  public static function getSubType($fid)
  {
    $parts = explode(':', $fid);
    switch(count($parts))
    {
      case 5:
        return $parts[2];
      case 4:
        return $parts[1];
      default:
        throw new InvalidFidException("Invalid FID Passed '$fid'", 500);
    }
  }

  /**
   * @param string $fid
   *
   * @return array
   *
   * @throws InvalidFidException
   */
  public static function getTypes($fid)
  {
    $parts = explode(':', $fid);
    switch(count($parts))
    {
      case 5:
        return [$parts[1], $parts[2]];
      case 4:
        return [$parts[1], $parts[1]];
      default:
        throw new InvalidFidException("Invalid FID Passed '$fid'", 500);
    }
  }

  public static function getFullType($fid)
  {
    return implode('_', static::getTypes($fid));
  }

  public static function validateType($type)
  {
    $reflection = new \ReflectionClass(
      '\Fortifi\FortifiApi\Foundation\Fids\FidTypes'
    );
    return $reflection->hasConstant($type);
  }

  /**
   * @param string $fid
   *
   * @return int
   */
  public static function getTime($fid)
  {
    $explode = explode(':', $fid);
    $time = array_slice($explode, -2, 1);
    return $time[0];
  }

  /**
   * @param string     $fid
   * @param bool|false $quick
   *
   * @return bool
   */
  public static function isFid($fid, $quick = false)
  {
    if(is_string($fid) && substr($fid, 0, 4) === 'FID:')
    {
      $c = substr_count($fid, ':');
      return $c == 3 || $c == 4;
    }
    else if($quick || ($fid === null))
    {
      return false;
    }

    if(is_object($fid))
    {
      $e = new \Exception(
        'Attempting to use ' . get_class($fid) . ' in fid check'
      );
      error_log($e->getMessage() . "\n" . $e->getTraceAsString());
    }
    else if(!is_string($fid))
    {
      $e = new \Exception(
        'Attemting to use ' . gettype($fid) . ' in fid check'
      );
      error_log($e->getMessage() . "\n" . $e->getTraceAsString());
    }

    return false;
  }

  public static function validateFid($fid, $type = null, $subType = null)
  {
    if(static::isFid($fid, true))
    {
      $types = static::getTypes($fid);
      if($type === null && $subType === null)
      {
        return static::validateType(implode('_', $types));
      }
      else if($subType === null)
      {
        return $type === $types[0];
      }
      else if($type === null)
      {
        return $subType === $types[1];
      }
      return $types == [$type, $subType];
    }
    return false;
  }

  /**
   * Compress a fid into a short, url friendly format
   *
   * @param $fid
   *
   * @return string
   */
  public static function compressFid($fid)
  {
    // remove FID: prefix
    $fid = preg_replace('/^FID:/', '', $fid);
    // subtract 2010 from timestamp
    $fid = preg_replace_callback(
      '/:([0-9]{10}):/',
      function ($v) {
        return ':' . base_convert($v[1], 10, 36) . ':';
      },
      $fid
    );
    // replace `:` with `-`
    return str_replace(':', '-', $fid);
  }

  /**
   * Decompress a compressed fid into its full version
   *
   * @param $compressedFid
   *
   * @return string
   */
  public static function expandFid($compressedFid)
  {
    // replace `:` with `-`
    $fid = str_replace('-', ':', $compressedFid);
    // add 2010 from timestamp
    $fid = preg_replace_callback(
      '/:([0-9a-z]{5,6}):/',
      function ($v) {
        return ':' . base_convert($v[1], 36, 10) . ':';
      },
      $fid
    );
    // add FID: prefix
    return 'FID:' . $fid;
  }
}
