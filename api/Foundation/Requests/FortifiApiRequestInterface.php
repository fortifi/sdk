<?php
namespace Fortifi\FortifiApi\Foundation\Requests;

use Packaged\Api\Interfaces\ApiRequestInterface;

interface FortifiApiRequestInterface extends ApiRequestInterface
{
  /**
   * @return $this
   */
  public function get();
}
