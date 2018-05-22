<?php
namespace Fortifi\FortifiApi\Foundation\Responses;

use Packaged\Api\Abstracts\AbstractApiResponse;

abstract class FortifiApiResponse extends AbstractApiResponse
{
  protected $_requestId;
  protected $_responseVersion;

  public function setRequestId($requestId)
  {
    $this->_requestId = $requestId;
    return $this;
  }

  public function getRequestId()
  {
    return $this->_requestId;
  }

  public function setResponseVersion($version)
  {
    $this->_responseVersion = $version;
    return $this;
  }

  public function getResponseVersion()
  {
    return $this->_responseVersion;
  }

  /**
   * Executed before sending the response
   */
  public function prepareForTransport()
  {
    foreach($this as $k => $v)
    {
      if($v instanceof FortifiApiResponse)
      {
        $v->prepareForTransport();
      }
      else if(is_array($v))
      {
        foreach($v as $vi => $vv)
        {
          if($vv instanceof FortifiApiResponse)
          {
            $vv->prepareForTransport();
          }
        }
      }
    }
  }

  /**
   * @param $property string
   * @param $class    string  Class name of the response class to construct
   *
   * @return $this
   */
  protected function _buildProperty($property, $class)
  {
    /**
     * @var $class AbstractApiResponse
     */
    if($this->$property
      && (is_array($this->$property) || is_object($this->$property))
    )
    {
      $items = [];
      foreach($this->$property as $k => $item)
      {
        $items[$k] = $class::make($item);
      }
      $this->$property = $items;
    }
    else if($this->$property === null)
    {
      $this->$property = [];
    }

    return $this;
  }
}
