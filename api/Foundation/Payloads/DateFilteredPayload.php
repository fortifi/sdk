<?php
namespace Fortifi\FortifiApi\Foundation\Payloads;

class DateFilteredPayload extends FiltersPayload
{
  /**
   * Mutually exclusive with $dates
   * Mutually inclusive with $dateEnd
   */
  public $dateStart;
  /**
   * Mutually exclusive with $dates
   * Mutually inclusive with $dateStart
   */
  public $dateEnd;
  /**
   * Mutually exclusive with $dateStart and $dateEnd
   */
  public $dates;
}
