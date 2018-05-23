<?php
namespace Fortifi\FortifiApi\Foundation\Responses;

use Packaged\Helpers\ValueAs;

class RawArrayResponse extends FortifiApiResponse
{
  /**
   * @var array
   */
  public $result;

  public function __construct(array $result = null)
  {
    $this->result = $result;
  }

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->result = ValueAs::arr($this->result);
  }
}
