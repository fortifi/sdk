<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Foundation\Exceptions\AccessDeniedException;
use Fortifi\Sdk\Fortifi;
use Packaged\Api\Interfaces\ApiRequestInterface;

abstract class FortifiModel
{
  /**
   * @var Fortifi
   */
  protected $_fortifi;

  protected function __construct()
  {
  }

  protected function _processRequest(ApiRequestInterface $request)
  {
    try
    {
      return $request->get();
    }
    catch(AccessDeniedException $e)
    {
      $this->_fortifi->getToken(true);
      return $request->get();
    }
  }

  public static function newInstance(Fortifi $fortifi)
  {
    $model = new static;
    $model->_fortifi = $fortifi;
    return $model;
  }

  protected function _getApi()
  {
    return $this->_fortifi->getApi();
  }
}
