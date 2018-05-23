<?php
namespace Fortifi\FortifiApi\Foundation\Payloads;

class MarkDatePayload extends FidPayload
{
  public $timestamp;

  /**
   * @param string   $fid
   * @param int|null $timestamp
   *
   * @return static
   */
  public static function create($fid, $timestamp = null)
  {
    /**
     * @var $payload MarkDatePayload
     */
    $payload = parent::create($fid);
    $payload->timestamp = $timestamp;
    return $payload;
  }
}
