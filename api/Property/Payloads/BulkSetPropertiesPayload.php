<?php
namespace Fortifi\FortifiApi\Property\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class BulkSetPropertiesPayload extends FidPayload
{
  /**
   * @gotype map[string]string
   */
  public $values = [];
  /**
   * @gotype map[string]bool
   */
  public $flags = [];
  /**
   * @gotype map[string]int64
   */
  public $incrementCounters = [];
  /**
   * @gotype map[string]int64
   */
  public $decrementCounters = [];
}
