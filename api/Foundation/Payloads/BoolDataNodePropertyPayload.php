<?php
namespace Fortifi\FortifiApi\Foundation\Payloads;

class BoolDataNodePropertyPayload extends DataNodePropertyPayload
{
  public $value;

  /**
   * @param string $fid
   * @param bool   $bool
   *
   * @return static
   */
  public static function create($fid, $bool = null)
  {
    if(!is_bool($bool))
    {
      throw new \InvalidArgumentException('Not a valid boolean value');
    }
    return parent::create($fid, $bool);
  }
}
