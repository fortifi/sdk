<?php
namespace Fortifi\FortifiApi\Foundation\Exceptions;

use Packaged\Api\Exceptions\ApiException;

class FortifiApiException extends ApiException
{
  /**
   * @var array
   */
  protected $_data = [];

  /**
   * @param null $key
   * @param null $default
   *
   * @return array|mixed|null
   */
  public function getData($key = null, $default = null)
  {
    if($key === null)
    {
      return $this->_data;
    }

    return array_key_exists($key, $this->_data) ? $this->_data[$key] : $default;
  }

  /**
   * @param array $data
   *
   * @return $this
   */
  public function setData(array $data)
  {
    $this->_data = $data;
    return $this;
  }

  public function addData($key, $value)
  {
    $this->_data[$key] = $value;
    return $this;
  }
}
