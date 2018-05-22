<?php
namespace Fortifi\FortifiApi\Helpers\Api;

use Fortifi\FortifiApi\FortifiApi;

/**
 * @deprecated
 */
abstract class FortifiApiModel
{
  /**
   * @var FortifiApi
   */
  private $_api;

  /**
   * Create a new API Model
   *
   * @param FortifiApi $api
   */
  public function __construct(FortifiApi $api)
  {
    $this->_api = $api;
  }

  /**
   * @return FortifiApi
   */
  protected function getApi()
  {
    return $this->_api;
  }
}
