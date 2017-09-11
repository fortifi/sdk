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

  public static function processRequest(
    Fortifi $fortifi, ApiRequestInterface $request
  )
  {
    try
    {
      return $request->get();
    }
    catch(AccessDeniedException $e)
    {
      $token = $fortifi->getToken(true);
      $fortifi->getApi()->setAccessToken($token->getToken());
      return $request->get();
    }
  }

  protected function _processRequest(ApiRequestInterface $request)
  {
    return static::processRequest($this->_fortifi, $request);
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
