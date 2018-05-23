<?php
namespace Fortifi\FortifiApi\Foundation\Responses;

class BoolResponse extends FortifiApiResponse
{
  /**
   * @var bool
   */
  public $result;
  /**
   * @var string
   */
  public $message;

  public function __construct($result = null, $message = null)
  {
    $this->result  = $result;
    $this->message = $message;
  }
}
