<?php
namespace Fortifi\FortifiApi\Property\Responses;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class PropertiesRetrieveResponse extends FortifiApiResponse
{
  /**
   * @gotype map[string]int64
   */
  public $counter = [];
  /**
   * @gotype map[string]bool
   */
  public $flag = [];
  /**
   * @gotype map[string]string
   */
  public $list = [];
  /**
   * @gotype map[string]string
   */
  public $set = [];
  /**
   * @gotype map[string]string
   */
  public $value = [];

  public function prepareForTransport()
  {
    parent::prepareForTransport();
    if(empty($this->counter))
    {
      $this->counter = new \stdClass();
    }
    if(empty($this->flag))
    {
      $this->flag = new \stdClass();
    }
    if(empty($this->list))
    {
      $this->list = new \stdClass();
    }
    if(empty($this->set))
    {
      $this->set = new \stdClass();
    }
    if(empty($this->value))
    {
      $this->value = new \stdClass();
    }
  }

}
